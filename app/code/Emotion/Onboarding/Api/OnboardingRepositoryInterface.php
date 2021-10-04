<?php

namespace Emotion\Onboarding\Api;

use Magento\Framework\Exception\CouldNotSaveException;
use Emotion\Onboarding\Api\Data\OnboardingDataInterface;

interface OnboardingRepositoryInterface
{
    /**
     *
     * @param $customerId
     * @return OnboardingDataInterface
     */
    public function get($customerId);

    /**
     *
     * @param OnboardingDataInterface $onboardingData
     * @return OnboardingDataInterface
     * @throws CouldNotSaveException
     */
    public function save(OnboardingDataInterface $onboardingData);
}
