<?php

namespace Emotion\Onboarding\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockRepository;

class UpdateCmsBlock implements DataPatchInterface
{
    // #Task 34
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var BlockRepository
     */
    protected $blockRepository;

    /**
     * AddAccessViolationPageAndAssignB2CCustomers constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param BlockRepository $blockRepository
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockRepository $blockRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockRepository = $blockRepository;
    }

    public static function getDependencies()
    {
        return [\Emotion\Onboarding\Setup\Patch\Data\CreateCmsBlock::class];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $block = $this->blockRepository->getById(
            \Emotion\Onboarding\Setup\Patch\Data\CreateCmsBlock::BLOCK_IDENTIFIER
        );
        $block->setContent('<div class="info">Updated block</div>');
        $this->blockRepository->save($block);

        $this->moduleDataSetup->endSetup();
    }
}
