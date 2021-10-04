<?php

namespace Emotion\Onboarding\Controller\Index;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Controller\ResultFactory;

class ChangeNamePost implements HttpPostActionInterface
{

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var RedirectInterface
     */
    protected $redirect;

    /**
     * @var ResultFactory
     */
    protected $result;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        RequestInterface $request,
        RedirectInterface $redirect,
        ResultFactory $result
    ) {
        $this->productRepository = $productRepository;
        $this->request = $request;
        $this->redirect = $redirect;
        $this->result = $result;
    }

    public function execute()
    {
        $sku = $this->request->getParam('sku');
        $name = $this->request->getParam('name');
        if (!empty($sku) && !empty($name)) {
            try {
                $product = $this->productRepository->get($sku);
                $product->setName($name);
                //TODO add correct scope
                $this->productRepository->save($product);
            } catch (\Exception $e) {
            }
        }
        $referrer = $this->redirect->getRefererUrl();
        $result = $this->result->create(ResultFactory::TYPE_REDIRECT);
        $result->setUrl($referrer);
        return $result;
    }
}
