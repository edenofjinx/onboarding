<?php

namespace Emotion\Onboarding\ViewModel;

use Magento\Framework\DataObject;
use Magento\Framework\Event\Manager;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class OnboardingViewModel implements ArgumentInterface
{

    /**
     * @var Manager
     */
    protected $eventManager;

    /**
     * @var DataObject
     */
    protected $dataObject;

    public function __construct(Manager $eventManager, DataObject $dataObject)
    {
        $this->eventManager = $eventManager;
        $this->dataObject = $dataObject;
    }

    public function getViewModelText(): string
    {
        $text = $this->dataObject->setText('View model text');
        $this->eventManager->dispatch('view_model_text_observer', ['view_model_text_data' => $text]);
        return $text->getText();
    }
}
