<?php

namespace Emotion\Onboarding\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;

class Form extends Template
{

    private $postUrl = '*/*/changenamepost';
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        Template\Context $context,
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    public function getProductBySku($sku)
    {
        try {
            return $this->productRepository->get($sku);
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    public function getPostUrl()
    {
        return $this->getUrl($this->postUrl);
    }
}
