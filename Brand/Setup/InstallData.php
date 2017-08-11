<?php

/**
 * @author Ruslan Miskiv
 *
 * Ruslan_Brand module Install data
 */

namespace Ruslan\Brand\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Ruslan\Brand\Setup\BrandSetupFactory;

/**
 * Class InstallData
 * @package Ruslan\Brand\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * Brand setup factory
     *
     * @var BrandSetupFactory
     */
    private $brandSetupFactory;

    /**
     * Init
     *
     * @param BrandSetupFactory $brandSetupFactory
     */
    public function __construct(BrandSetupFactory $brandSetupFactory)
    {
        $this->brandSetupFactory = $brandSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $brandSetup = $this->brandSetupFactory->create(['setup' => $setup]);
        $brandSetup->installEntities();
    }
}
