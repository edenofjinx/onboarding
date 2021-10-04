<?php

namespace Emotion\Onboarding\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Emotion\Onboarding\Helper\Config;

class Task extends Template
{

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteria;

    /**
     * @var CollectionFactory
     */
    protected $productCollection;

    /**
     * @var Config
     */
    protected $helper;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteria,
        CollectionFactory $productCollection,
        Config $helper,
        Template\Context $context,
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        $this->searchCriteria = $searchCriteria;
        $this->productCollection = $productCollection;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    public function getText(): string
    {
        return __('Onboarding text');
    }

    public function getInfoText(): string
    {
        return $this->getData('information_text') ?? __('No data');
    }

    public function getProductBySku($sku)
    {
        try {
            return $this->productRepository->get($sku);
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    public function getProductById($id)
    {
        try {
            return $this->productRepository->getById($id);
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    public function getProductList()
    {
        $searchCriteria = $this->searchCriteria->addFilter(
            'name',
            '%backpack%',
            'like'
        )->create();
        return $this->productRepository->getList($searchCriteria);
    }

    public function getProductCollection()
    {
        $collection = $this->productCollection->create();
        $collection->addAttributeToSelect('*')
            ->addAttributeToFilter('name', ['like' => '%backpack%'])
            ->setOrder('price', 'ASC');
        return $collection;
    }

    public function getConfigText()
    {
        return $this->helper->getConfigText();
    }

    public function getActive()
    {
        return $this->helper->getActive();
    }
}
