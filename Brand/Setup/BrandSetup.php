<?php

namespace Ruslan\Brand\Setup;

use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Ruslan\Brand\Model\DataFactory;

class BrandSetup extends EavSetup
{
    /**
     * Category model factory
     *
     * @var DataFactory
     */

    private $dataFactory;
    /**
     * Init
     *
     * @param ModuleDataSetupInterface $setup
     * @param Context $context
     * @param CacheInterface $cache
     * @param CollectionFactory $attrGroupCollectionFactory
     * @param DataFactory $dataFactory
     */

    public function __construct(
        ModuleDataSetupInterface $setup,
        Context $context,
        CacheInterface $cache,
        CollectionFactory $attrGroupCollectionFactory,
        DataFactory $dataFactory
    ) {
        $this->dataFactory = $dataFactory;
        parent::__construct($setup, $context, $cache, $attrGroupCollectionFactory);
    }

    /**
     * Creates data model
     *
     * @param array $data
     * @return \Ruslan\Brand\Model\Data
     * @codeCoverageIgnore
     */
    public function createCategory($data = [])
    {
        return $this->dataFactory->create($data);
    }

    /**
     * Default entities and attributes
     *
     * @return array
     */
    public function getDefaultEntities()
    {
        return [
            'ruslan_brand' => [
                'entity_model' => 'Ruslan\Brand\Model\ResourceModel\Data',
                'attribute_model' => 'Magento\Catalog\Model\ResourceModel\Eav\Attribute',
                'table' => 'ruslan_brand_entity',
                'entity_attribute_collection' => 'Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection',
                'attributes' => [
                    'name' => [
                        'type' => 'varchar',
                        'label' => 'Name',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 1,
                        'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                    ],
                    'description' => [
                        'type' => 'text',
                        'label' => 'Description',
                        'input' => 'textarea',
                        'required' => false,
                        'sort_order' => 2,
                        'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                    ],
                    'image' => [
                        'type' => 'varchar',
                        'label' => 'Image',
                        'input' => 'image',
                        "backend"  => "Ruslan\Brand\Model\Attribute\Source\Image",
                        'required' => false,
                        'sort_order' => 3,
                        'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                    ],
                    'is_active' => [
                        'type' => 'int',
                        'label' => 'Active',
                        'input' => 'select',
                        'required' => true,
                        'sort_order' => 4,
                        'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                    ],
                ],
            ]
        ];
    }
}
