<?php

namespace Emotion\Onboarding\Model\Checkout;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\View\LayoutInterface;

class ConfigProvider implements ConfigProviderInterface
{

    /** @var LayoutInterface  */
    protected $layout;
    protected $cmsBlock;

    public function __construct(LayoutInterface $layout, $blockId)
    {
        $this->layout = $layout;
        $this->cmsBlock = $this->constructBlock($blockId);
    }

    public function constructBlock($blockId){
        $block = $this->layout->createBlock('Magento\Cms\Block\Block')
            ->setBlockId($blockId)->toHtml();
        return $block;
    }

    public function getConfig()
    {
        return [
            'cms_block' => $this->cmsBlock
        ];
    }
}
