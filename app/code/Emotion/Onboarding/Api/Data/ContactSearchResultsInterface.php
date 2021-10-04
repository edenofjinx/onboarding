<?php

namespace Emotion\Onboarding\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ContactSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get assets list.
     *
     * @return \Emotion\Onboarding\Api\Data\ContactDataInterface[]
     */
    public function getItems();

    /**
     * Set assets list.
     *
     * @param \Emotion\Onboarding\Api\Data\ContactDataInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

