<?php

namespace Emotion\Onboarding\Plugin\OnboardingData;

use Emotion\Onboarding\Api\OnboardingRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\RequestInterface;

class AfterGetPlugin
{

    /**
     * @var OnboardingRepositoryInterface
     */
    protected $onboardingRepository;

    /**
     * @var RequestInterface
     */
    protected $request;

    public function __construct(OnboardingRepositoryInterface $onboardingRepository, RequestInterface $request)
    {
        $this->onboardingRepository = $onboardingRepository;
        $this->request = $request;
    }

    public function afterGetById(
        \Magento\Customer\Api\CustomerRepositoryInterface $subject,
        \Magento\Customer\Api\Data\CustomerInterface $customer
    ) {
        $onboardingData = $this->onboardingRepository->get($customer->getId());
        $extensionAttributes = $customer->getExtensionAttributes();
        $extensionAttributes->setNewOnboardingName($onboardingData->getOnboardingName());
        $extensionAttributes->setOnboardingLastname($onboardingData->getOnboardingLastname());
        $customer->setExtensionAttributes($extensionAttributes);
        return $customer;
    }

    public function afterSave(
        CustomerRepositoryInterface $subject,
        CustomerInterface $result,
        CustomerInterface $customer
    ) {
        if (!$customer->getId()) {
            return $result;
        }
        $onboardingName = $this->request->getParam('onboarding_name');
        $onboardingLastname = $this->request->getParam('onboarding_lastname');
        $onboardingData = $this->onboardingRepository->get($customer->getId());
        if (!$onboardingData->getCustomerId()) {
            $onboardingData->setCustomerId($customer->getId());
        }
        $onboardingData->setOnboardingName($onboardingName);
        $onboardingData->setOnboardingLastname($onboardingLastname);
        $this->onboardingRepository->save($onboardingData);
        return $result;
    }
}
