<?php

namespace Emotion\Onboarding\Api\Data;

interface OnboardingDataInterface
{
    const CUSTOMER_ENTITY_ID = 'customer_entity_id';
    const CUSTOMER_ONBOARDING_NAME = 'new_onboarding_name';
    const CUSTOMER_ONBOARDING_LASTNAME = 'onboarding_lastname';

    /**
     * @return string|null
     */
    public function getCustomerId();

    /**
     * @param $customerId
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * @return string|null
     */
    public function getOnboardingName();

    /**
     * @param $onboardingName
     * @return $this
     */
    public function setOnboardingName($onboardingName);

    /**
     * @return string|null
     */
    public function getOnboardingLastname();

    /**
     * @param $onboardingLastname
     * @return $this
     */
    public function setOnboardingLastname($onboardingLastname);


}
