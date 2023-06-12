<?php

namespace Troia\QuestionSaler\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('question_saler')) {
            $table = $installer->getConnection()->newTable($installer->getTable('question_saler'))
                ->addColumn('id', Table::TYPE_INTEGER, null, ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true,], 'ID')
                ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable => false'], 'Customer name')
                ->addColumn('email', Table::TYPE_TEXT, 255, ['nullable => true'], 'Customer email')
                ->addColumn('telephone', Table::TYPE_TEXT, 255, ['nullable => false'], 'Customer phone')
                ->addColumn('question', Table::TYPE_TEXT, 255, ['nullable => false'], 'Customer question')
                ->addColumn('status', Table::TYPE_INTEGER, 255, ['nullable => false, default => 0'], 'Customer question');

            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
