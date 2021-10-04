<?php

namespace Emotion\Onboarding\Api\Data;

interface ContactDataInterface
{
    const CONTACT_ENTITY_ID = 'entity_id';
    const CONTACT_NAME = 'name';
    const CONTACT_EMAIL = 'email';
    const CONTACT_POSITION = 'position';

    /**
     * @return string|null
     */
    public function getContactId();

    /**
     * @param $contactId
     * @return $this
     */
    public function setContactId($contactId);

    /**
     * @return string|null
     */
    public function getContactName();

    /**
     * @param $contactName
     * @return $this
     */
    public function setContactName($contactName);

    /**
     * @return string|null
     */
    public function getContactEmail();

    /**
     * @param $contactEmail
     * @return $this
     */
    public function setContactEmail($contactEmail);

    /**
     * @return string|null
     */
    public function getContactPostion();

    /**
     * @param $contactPosition
     * @return $this
     */
    public function setContactPosition($contactPosition);
}
