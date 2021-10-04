<?php

namespace Emotion\Onboarding\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class DisplayNicknameInCustomerGrid implements DataPatchInterface
{

    private const CUSTOMER_NICKNAME = 'nickname';

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;


    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public static function getDependencies()
    {
        return [\Emotion\Onboarding\Setup\Patch\Data\AddNicknameForCustomer::class];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->updateAttribute(Customer::ENTITY, self::CUSTOMER_NICKNAME, [
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_searchable_in_grid' => true
        ]);
    }
}
