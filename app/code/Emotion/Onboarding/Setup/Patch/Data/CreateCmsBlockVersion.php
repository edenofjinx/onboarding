<?php

namespace Emotion\Onboarding\Setup\Patch\Data;

use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\BlockRepository;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;

class CreateCmsBlockVersion implements DataPatchInterface, PatchVersionInterface, PatchRevertableInterface
{

    // #Task 35

    public const BLOCK_IDENTIFIER_VERSION = 'onboarding-new-block-version';
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * @var BlockRepository
     */
    protected $blockRepository;

    /**
     * AddAccessViolationPageAndAssignB2CCustomers constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param BlockFactory $blockFactory
     * @param BlockRepository $blockRepository
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory,
        BlockRepository $blockRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
        $this->blockRepository = $blockRepository;
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
        $newCmsStaticBlock = [
            'title' => 'New Cms block with patch versioning',
            'identifier' => self::BLOCK_IDENTIFIER_VERSION,
            'content' => '<div class="info">New block content</div>',
            'is_active' => 1,
            'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
        ];

        $this->moduleDataSetup->startSetup();

        /** @var \Magento\Cms\Model\Block $block */
        $block = $this->blockFactory->create();
        $block->setData($newCmsStaticBlock);
        $this->blockRepository->save($block);

        $this->moduleDataSetup->endSetup();
    }

    public static function getVersion()
    {
        return '2.0.0';
    }

    public function revert()
    {
        $this->moduleDataSetup->startSetup();
        $this->blockRepository->deleteById(self::BLOCK_IDENTIFIER_VERSION);
        $this->moduleDataSetup->endSetup();
    }
}
