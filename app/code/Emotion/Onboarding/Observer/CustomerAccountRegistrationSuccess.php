<?php

namespace Emotion\Onboarding\Observer;

use Emotion\Onboarding\Model\OnboardingRepository;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Emotion\Onboarding\Api\Data\OnboardingDataInterfaceFactory;

class CustomerAccountRegistrationSuccess implements ObserverInterface
{

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var OnboardingRepository
     */
    protected $onboardingRepository;

    /**
     * @var OnboardingDataInterfaceFactory
     */
    protected $onboardingFactory;

    public function __construct(
        RequestInterface $request,
        OnboardingRepository $onboardingRepository,
        OnboardingDataInterfaceFactory $onboardingFactory
    ) {
        $this->request = $request;
        $this->onboardingRepository = $onboardingRepository;
        $this->onboardingFactory = $onboardingFactory;
    }

    public function execute(Observer $observer)
    {
        $customer = $observer->getCustomer();
        if ($customer && $customer->getId()) {
            $this->addOnboardingData($customer);
        }
    }

    protected function addOnboardingData($customer)
    {
        $onboardingName = $this->request->getParam('onboarding_name');
        $onboardingLastname = $this->request->getParam('onboarding_lastname');
        try {
            $onboardingData = $this->onboardingFactory->create();
            $onboardingData->setCustomerId($customer->getId());
            $onboardingData->setOnboardingName($onboardingName);
            $onboardingData->setOnboardingLastname($onboardingLastname);
            $this->onboardingRepository->save($onboardingData);
        } catch (\Exception $e) {
            return;
        }
    }
}
