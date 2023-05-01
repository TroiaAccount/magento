<?php

namespace Perspective\Sales\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Perspective\Sales\Model\SalesTableFactory;

/**
 * Patch is mechanism, that allows to do atomic upgrade data changes.
 */
class LoadPricePatch implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var SalesTableFactory
     */
    protected SalesTableFactory $salesTable;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param SalesTableFactory $salesTable
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        SalesTableFactory $salesTable,
    )
    {
        $this->salesTable = $salesTable;
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

        $sales1 = $this->salesTable->create();
        $sales1->setName('Product A')
            ->setQuantitySold(3)
            ->setDate('2022-04-06 03:00:00')
            ->setDiscount(0.1)->save();

        $sales2 = $this->salesTable->create();
        $sales2->setName('Product B')
            ->setQuantitySold(3)
            ->setDate('2022-04-06 03:00:00')
            ->setDiscount(0.1)
            ->save();
        $salesCollection = $this->salesTable->create()->getData();
        foreach ($salesCollection as $item){
            $item->setData('price', rand(1, 100));
            $item->save();
        }
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
