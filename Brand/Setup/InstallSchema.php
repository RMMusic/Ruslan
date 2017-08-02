<?php
namespace Ruslan\Brand\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable('temp');

        if (!$installer->tableExists('temp')) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'data_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Data ID'
                )
                ->addColumn(
                    'data_title',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Data Title'
                )
                ->addColumn(
                    'data_description',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Data Description'
                )
                ->addColumn(
                    'is_active',
                    Table::TYPE_SMALLINT,
                    null,
                    ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                    'Status'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Updated At'
                );
            $installer->getConnection()->createTable($table);
        }

        /**
         * Create table 'ruslan_brand_entity'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('ruslan_brand_entity'))
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity ID'
            )
            ->addColumn(
                'brand_name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Brand name'
            )
            ->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false],
                'Is active'
            )
            ->setComment('Ruslan Brand Table');
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'ruslan_brand_entity_text'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('ruslan_brand_entity_text'))
            ->addColumn(
                'value_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Value ID'
            )
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Entity ID'
            )
            ->addColumn(
                'description',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Brand description'
            )
            ->addColumn(
                'image',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Brand image'
            )
            ->addForeignKey(
                $installer->getFkName(
                    'ruslan_brand_entity_text',
                    'entity_id',
                    'ruslan_brand_entity',
                    'entity_id'
                ),
                'entity_id',
                $installer->getTable('ruslan_brand_entity'),
                'entity_id',
                Table::ACTION_CASCADE
            )
            ->setComment('Ruslan Brand Text Table');
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}