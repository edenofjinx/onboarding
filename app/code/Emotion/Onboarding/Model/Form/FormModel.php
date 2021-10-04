<?php

namespace Emotion\Onboarding\Model\Form;

use Emotion\Onboarding\Model\ResourceModel\ContactForm;
use Magento\Framework\Model\AbstractModel;

class FormModel extends AbstractModel
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    protected $_dateTime;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ContactForm::class);
    }
}
