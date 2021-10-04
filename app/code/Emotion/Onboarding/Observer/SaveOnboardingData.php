<?php

namespace Emotion\Onboarding\Observer;

use Emotion\Onboarding\Model\OnboardingRepository;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SaveOnboardingData implements ObserverInterface
{

    /**
     * @var OnboardingRepository
     */
    protected $onboardingRepository;

    /**
     * @var AuthorizationInterface
     */
    private $authorization;

    public function __construct(
        OnboardingRepository $onboardingRepository,
        AuthorizationInterface $authorization
    ) {
        $this->onboardingRepository = $onboardingRepository;
        $this->authorization = $authorization;
    }

    public function execute(Observer $observer)
    {
        if ($this->authorization->isAllowed('Emotion_Onboarding::view_extensions')) {
            $customer = $observer->getCustomer();
            if ($customer && $customer->getId()) {
                $this->addOnboardingData($customer);
            }
        }
    }

    protected function addOnboardingData($customer)
    {
        $extensionAttributes = $customer->getExtensionAttributes();
        $onboardingName = $extensionAttributes->getNewOnboardingName();
        $onboardingLastname = $extensionAttributes->getOnboardingLastname();
        try {
            $onboardingData = $this->onboardingRepository->get($customer->getId());
            $onboardingData->setCustomerId($customer->getId());
            $onboardingData->setOnboardingName($onboardingName);
            $onboardingData->setOnboardingLastname($onboardingLastname);
            $this->onboardingRepository->save($onboardingData);
        } catch (\Exception $e) {
            return;
        }
    }
}
