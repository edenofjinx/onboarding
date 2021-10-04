<?php

namespace Emotion\Onboarding\Api;

use Magento\Framework\Exception\CouldNotSaveException;
use Emotion\Onboarding\Api\Data\ContactDataInterface;
use Emotion\Onboarding\Api\Data\ContactSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ContactRepositoryInterface
{
    /**
     *
     * @param int $contactId
     * @return ContactDataInterface
     */
    public function get($contactId);

    /**
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return ContactSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     *
     * @param ContactDataInterface $contactData
     * @return ContactDataInterface
     * @throws CouldNotSaveException
     */
    public function save(ContactDataInterface $contactData);

    /**
     * @param string $contactId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($contactId);
}
