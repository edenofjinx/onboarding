<?php

namespace Emotion\Onboarding\Plugin\OnboardingData;

use Emotion\Onboarding\Api\OnboardingRepositoryInterface;
use Magento\Framework\AuthorizationInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 *
 * @see DataProvider
 */
class CustomerDataProvider
{

    const VIEW_EXTENSION_DATA = 'Emotion_Onboarding::view_extensions';

    /** @var OnboardingRepositoryInterface */
    private $onboardingRepository;

    /**
     * @var AuthorizationInterface
     */
    private $authorization;

    /**
     * @param OnboardingRepositoryInterface $repository
     */
    public function __construct(OnboardingRepositoryInterface $repository, AuthorizationInterface $authorization)
    {
        $this->onboardingRepository = $repository;
        $this->authorization = $authorization;
    }

    /**
     *
     * @see DataProvider::getData() Intercepted method
     * @param DataProvider $subject
     * @param array $data
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetData(AbstractDataProvider $subject, $data)
    {
        if ($this->authorization->isAllowed(self::VIEW_EXTENSION_DATA)) {
            foreach ($data as $key => $value) {
                $customerId = $value['customer_id'];
                if ($customerId) {
                    $additionalAttributes = $this->onboardingRepository->get($customerId);
                    $data[$key]['customer']['extension_attributes']['new_onboarding_name'] =
                        $additionalAttributes->getNewOnboardingName();
                    $data[$key]['customer']['extension_attributes']['onboarding_lastname'] =
                        $additionalAttributes->getOnboardingLastname();
                }
            }
        }

        return $data;
    }
}
