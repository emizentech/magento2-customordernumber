<?php
/**
 * Copyright © 2015 EmizenTech. All rights reserved.
 */

namespace EmizenTech\CustomOrderNumber\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
        $table  = $installer->getConnection()
            ->newTable($installer->getTable('emizentech_customordernumber'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['auto_increment' => true,'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Id'
            )
            ->addColumn(
                'startup',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['default' => null],
                'StartUp'
            )
            ->addColumn(
                'currentid',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['default' => null],
                'Currentid'
            );
        $installer->getConnection()->createTable($table);
        
        $table  = $installer->getConnection()
            ->newTable($installer->getTable('emizentech_custominvoicenumber'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['auto_increment' => true,'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Id'
            )
            ->addColumn(
                'startup',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['default' => null],
                'StartUp'
            )
            ->addColumn(
                'currentid',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['default' => null],
                'Currentid'
            );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
