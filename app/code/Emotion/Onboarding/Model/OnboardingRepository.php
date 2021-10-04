<?php

namespace Emotion\Onboarding\Model;

use Emotion\Onboarding\Api\Data\OnboardingDataInterface;
use Emotion\Onboarding\Api\OnboardingRepositoryInterface;
use Emotion\Onboarding\Model\ResourceModel\OnboardingResourceConfig;
use Emotion\Onboarding\Api\Data\OnboardingDataInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;

class OnboardingRepository implements OnboardingRepositoryInterface
{

    private $onboardingDataResource;

    private $onboardingDataFactory;

    public function __construct(
        OnboardingResourceConfig $onboardingDataResource,
        OnboardingDataInterfaceFactory $onboardingDataFactory
    ) {
        $this->onboardingDataResource = $onboardingDataResource;
        $this->onboardingDataFactory = $onboardingDataFactory;
    }

    public function get($customerId)
    {
        $config = $this->onboardingDataFactory->create();

        $this->onboardingDataResource->load($config, $customerId);

        return $config;
    }

    public function save(OnboardingDataInterface $onboardingData)
    {
        try {
            $this->onboardingDataResource->save($onboardingData);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('There was an error saving extension data.'));
        }

        return $onboardingData;
    }
}
