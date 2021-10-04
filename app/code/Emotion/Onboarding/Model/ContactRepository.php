<?php

namespace Emotion\Onboarding\Model;

use Emotion\Onboarding\Api\Data\ContactDataInterface;
use Emotion\Onboarding\Api\ContactRepositoryInterface;
use Emotion\Onboarding\Api\Data\ContactSearchResultsInterface;
use Emotion\Onboarding\Model\ResourceModel\ContactForm;
use Emotion\Onboarding\Api\Data\ContactDataInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;

class ContactRepository implements ContactRepositoryInterface
{

    private $contactDataResource;

    private $contactDataFactory;

    public function __construct(
        ContactForm $onboardingDataResource,
        ContactDataInterfaceFactory $onboardingDataFactory
    ) {
        $this->contactDataResource = $onboardingDataResource;
        $this->contactDataFactory = $onboardingDataFactory;
    }

    /**
     * @param int $contactId
     * @return ContactDataInterface
     */
    public function get($contactId)
    {
        $config = $this->contactDataFactory->create();

        $this->contactDataResource->load($config, $contactId);

        return $config;
    }

    public function save(ContactDataInterface $contactData)
    {
        try {
            $this->contactDataResource->save($contactData);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('There was an error saving extension data.'));
        }

        return $contactData;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        //TODO implement getList
        return [];
    }

    public function deleteById($contactId)
    {
        $employee = $this->get($contactId);
        $this->contactDataResource->delete($employee);
    }
}
