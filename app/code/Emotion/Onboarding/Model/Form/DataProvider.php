<?php

namespace Emotion\Onboarding\Model\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Emotion\Onboarding\Model\ResourceModel\ContactFormCollectionFactory;

class DataProvider extends AbstractDataProvider
{

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ContactFormCollectionFactory $contactCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $contactCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = [];
        foreach ($items as $contact) {
            $this->loadedData[$contact->getId()]['contact'] = $contact->getData();
        }

        return $this->loadedData;
    }
}
