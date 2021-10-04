<?php

declare(strict_types=1);

namespace Emotion\Onboarding\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;


class OnboardingResourceConfig extends AbstractDb
{
    /**#@+*/
    private const TABLE = 'new_onboarding_data';
    private const PRIMARY_KEY = 'customer_entity_id';
    /**#@-*/

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_isPkAutoIncrement = false;
        $this->_useIsObjectNew = true;

        $this->_init(
            self::TABLE,
            self::PRIMARY_KEY
        );
    }
}
