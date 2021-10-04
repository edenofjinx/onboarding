<?php

namespace Emotion\Onboarding\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Emotion\Onboarding\Model\Form\FormModel;
use Emotion\Onboarding\Model\ResourceModel\ContactForm;

class ContactFormCollection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(FormModel::class, ContactForm::class);
    }
}
