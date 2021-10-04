<?php

namespace Emotion\Onboarding\Model\Contact;

use Emotion\Onboarding\Api\Data\ContactDataInterface;
use Magento\Framework\Model\AbstractModel;
use Emotion\Onboarding\Model\ResourceModel\ContactForm;

class ContactData extends AbstractModel implements ContactDataInterface
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(ContactForm::class);
        parent::_construct();
    }

    public function getContactId()
    {
        return $this->getData(self::CONTACT_ENTITY_ID);
    }

    public function setContactId($contactId)
    {
        return $this->setData(self::CONTACT_ENTITY_ID, $contactId);
    }

    public function getContactName()
    {
        return $this->getData(self::CONTACT_NAME);
    }

    public function setContactName($contactName)
    {
        return $this->setData(self::CONTACT_NAME, $contactName);
    }

    public function getContactEmail()
    {
        return $this->getData(self::CONTACT_EMAIL);
    }

    public function setContactEmail($contactEmail)
    {
        return $this->setData(self::CONTACT_EMAIL, $contactEmail);
    }

    public function getContactPostion()
    {
        return $this->getData(self::CONTACT_POSITION);
    }

    public function setContactPosition($contactPosition)
    {
        return $this->setData(self::CONTACT_POSITION, $contactPosition);
    }
}
