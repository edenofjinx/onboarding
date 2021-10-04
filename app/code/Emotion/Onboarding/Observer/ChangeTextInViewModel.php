<?php

namespace Emotion\Onboarding\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangeTextInViewModel implements ObserverInterface
{

    public function execute(Observer $observer)
    {
        $viewModelData = $observer->getViewModelTextData();
        $text = 'Additional text via observer.';
        $viewModelData->setText($text);
        return $this;
    }
}
