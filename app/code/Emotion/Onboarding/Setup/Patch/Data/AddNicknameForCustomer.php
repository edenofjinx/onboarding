<?php

namespace Emotion\Onboarding\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Model\Config as eavConfig;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddNicknameForCustomer implements DataPatchInterface
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

    /**
     * @var AttributeSetFactory
     */
    protected $attributeSetFactory;

    /**
     * @var EavSetup
     */
    private $eavSetupFactory;

    /**
     * @var eavConfig
     */
    protected $eavConfig;

    /**
     * @var Attribute
     */
    protected $attribute;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory,
        EavSetup $eavSetupFactory,
        eavConfig $eavConfig,
        Attribute $attribute
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attribute = $attribute;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        try {
            $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
        } catch (LocalizedException $e) {
            $customerEntity = null;
        }
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        /** @var $attributeSet AttributeSet */
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
        $customerSetup->addAttribute(Customer::ENTITY, self::CUSTOMER_NICKNAME, [
            'label' => 'Customer nickname',
            'type' => 'varchar',
            'input' => 'text',
            'backend' => '',
            'frontend' => '',
            'source' => '',
            'visible' => true,
            'required' => false,
            'unique' => false,
            'user_defined' => true,
            'position' => 300,
            'system' => false,
            'visible_on_front' => true,
            'is_filterable_in_grid' => true,
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_searchable_in_grid' => false,
            'is_used_for_customer_segment' => false,
            'filterable' => true,
            'filterable_in_search' => true
        ]);
        $attribute = $customerSetup->getEavConfig()
            ->getAttribute(Customer::ENTITY, self::CUSTOMER_NICKNAME)
            ->addData(
                [
                    'attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,
                    'used_in_forms' => ['adminhtml_customer', 'customer_account_edit', 'customer_account_create']
                ]
            );
        $this->attribute->save($attribute);
    }
}
