<?php

namespace Perspective\Sales\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Patch is mechanism, that allows to do atomic upgrade data changes.
 */
class InstallDataPatch implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;


    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * Do Upgrade.
     *
     * @return void
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $data = [
            ['name' => 'Product 1', 'quantity' => 10, 'date' => '2022-04-01', 'discount' => 0.05],
            ['name' => 'Product 2', 'quantity' => 5, 'date' => '2022-04-02', 'discount' => 0.1],
            ['name' => 'Product 1', 'quantity' => 15, 'date' => '2022-04-03', 'discount' => null],
            ['name' => 'Product 3', 'quantity' => 20, 'date' => '2022-04-04', 'discount' => 0.05],
            ['name' => 'Product 4', 'quantity' => 8, 'date' => '2022-04-05', 'discount' => null],
        ];
        $this->moduleDataSetup->getConnection()->insertMultiple($this->moduleDataSetup->getTable('sales_table'), $data);
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * Example of implementation:
     *
     * [
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
     * ]
     *
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }
}
