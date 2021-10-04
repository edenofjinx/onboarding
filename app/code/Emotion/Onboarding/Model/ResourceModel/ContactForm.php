<?php


namespace Emotion\Onboarding\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ContactForm extends AbstractDb
{

    /**#@+*/
    private const TABLE = 'company_employees';
    private const PRIMARY_KEY = 'entity_id';
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
