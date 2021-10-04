<?php

namespace Emotion\Onboarding\Console\Command;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\State;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChangesViaCli extends Command
{
    /**
     * @var State
     */
    private $state;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteria;

    public function __construct(
        State $state,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteria,
        string $name = null
    ) {
        $this->state = $state;
        $this->productRepository = $productRepository;
        $this->searchCriteria = $searchCriteria;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('onboarding:product:change');
        $this->setDescription('Add special price for products and change their name.');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);
        try {
            $output->writeln('Getting products. ');
            $filter = $this->searchCriteria->addFilter('price', 30, 'from');
            $filter = $this->searchCriteria->addFilter('price', 35, 'to');
            $searchCriteria = $filter->create();
            $products = $this->productRepository->getList($searchCriteria);
            if ($products->getTotalCount() > 0) {
                $productTotal = $products->getTotalCount();
                $output->writeln('Product count: ' . $productTotal);
                $i = 1;
                foreach ($products->getItems() as $product) {
                    $output->writeln('Product ' . $i . ' out of ' . $productTotal);
                    $name = $product->getName() . ' ' . $product->getSku();
                    $output->writeln('Product name: ' . $name);
                    $specialPrice = $product->getPrice() - 5;
                    $output->writeln('Product special price: ' . $specialPrice);
                    $product->setName($name);
                    $product->setSpecialPrice($specialPrice);
                    //TODO add correct scope
                    $this->productRepository->save($product);
                    $i++;
                }

            }
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return Cli::RETURN_FAILURE;
        }
        $output->writeln("Product changes were successful!");
        return Cli::RETURN_SUCCESS;
    }
}
