<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/* @var $installer \Magento\Setup\Module\SetupModule */
$installer = $this;

/* @var $connection \Magento\Framework\DB\Adapter\AdapterInterface */
$connection = $installer->getConnection();

$installer->startSetup();

/**
 * Create table 'theme'
 */
$table = $connection->newTable(
    $installer->getTable('theme')
)->addColumn(
    'theme_id',
    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
    null,
    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
    'Theme identifier'
)->addColumn(
    'parent_id',
    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
    null,
    ['nullable' => true],
    'Parent Id'
)->addColumn(
    'theme_path',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,
    ['nullable' => true],
    'Theme Path'
)->addColumn(
    'theme_version',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,
    ['nullable' => false],
    'Theme Version'
)->addColumn(
    'theme_title',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,
    ['nullable' => false],
    'Theme Title'
)->addColumn(
    'preview_image',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,
    ['nullable' => true],
    'Preview Image'
)->addColumn(
    'is_featured',
    \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
    null,
    ['nullable' => false, 'default' => 0],
    'Is Theme Featured'
)->addColumn(
    'area',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,
    ['nullable' => false],
    'Theme Area'
)->addColumn(
    'type',
    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
    null,
    ['nullable' => false],
    'Theme type: 0:physical, 1:virtual, 2:staging'
)->addColumn(
    'code',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    null,
    [],
    'Full theme code, including package'
)->setComment(
    'Core theme'
);
$connection->createTable($table);

/**
 * Create table 'theme_file'
 */
$table = $connection->newTable(
    $installer->getTable('theme_file')
)->addColumn(
    'theme_files_id',
    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
    null,
    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
    'Theme files identifier'
)->addColumn(
    'theme_id',
    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
    null,
    ['nullable' => false, 'unsigned' => true],
    'Theme Id'
)->addColumn(
    'file_path',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    255,
    ['nullable' => true],
    'Relative path to file'
)->addColumn(
    'file_type',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    32,
    ['nullable' => false],
    'File Type'
)->addColumn(
    'content',
    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
    \Magento\Framework\DB\Ddl\Table::MAX_TEXT_SIZE,
    ['nullable' => false],
    'File Content'
)->addColumn(
    'sort_order',
    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
    null,
    ['nullable' => false, 'default' => 0],
    'Sort Order'
)->addColumn(
    'is_temporary',
    \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
    null,
    ['nullable' => false, 'default' => 0],
    'Is Temporary File'
)->addForeignKey(
    $installer->getFkName('theme_file', 'theme_id', 'theme', 'theme_id'),
    'theme_id',
    $installer->getTable('theme'),
    'theme_id',
    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
)->setComment(
    'Core theme files'
);
$connection->createTable($table);

$installer->endSetup();
