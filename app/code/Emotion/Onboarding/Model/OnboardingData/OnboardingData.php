<?php

namespace Emotion\Onboarding\Model\OnboardingData;

use Emotion\Onboarding\Api\Data\OnboardingDataInterface;
use Emotion\Onboarding\Model\ResourceModel\OnboardingResourceConfig;
use Magento\Framework\Model\AbstractModel;

class OnboardingData extends AbstractModel implements OnboardingDataInterface
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(OnboardingResourceConfig::class);
        parent::_construct();
    }

    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ENTITY_ID);
    }

    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ENTITY_ID, $customerId);
    }

    public function getOnboardingName()
    {
        return $this->getData(self::CUSTOMER_ONBOARDING_NAME);
    }

    public function setOnboardingName($onboardingName)
    {
        return $this->setData(self::CUSTOMER_ONBOARDING_NAME, $onboardingName);
    }

    public function getOnboardingLastname()
    {
        return $this->getData(self::CUSTOMER_ONBOARDING_LASTNAME);
    }

    public function setOnboardingLastname($onboardingLastname)
    {
        return $this->setData(self::CUSTOMER_ONBOARDING_LASTNAME, $onboardingLastname);
    }
}
