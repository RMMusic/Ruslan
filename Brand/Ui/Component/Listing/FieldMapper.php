<?php

namespace Ruslan\Brand\Ui\Component\Listing;

use Ruslan\Brand\Api\Data\DataInterface;
use Magento\Eav\Api\AttributeGroupRepositoryInterface;
use Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory as AttributeCollectionFactory;

class FieldMapper
{
    /**
     * Attribute group repository
     *
     * @var AttributeGroupRepositoryInterface
     */
    private $attributeGroupRepository;

    /**
     * Attributes collection
     *
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection
     */
    private $attributesCollection;

    /**
     * Fields map
     *
     * @var string[]
     */
    private $fieldsMap = [];

    /**
     * Fieldsets
     *
     * @var array
     */
    private $fieldsets = [];

    /**
     * FieldMapper constructor.
     * @param AttributeCollectionFactory $attributeCollectionFactory
     * @param AttributeGroupRepositoryInterface $attributeGroupRepository
     * @param $attributeSetId
     */
    public function __construct(
        AttributeCollectionFactory $attributeCollectionFactory,
        AttributeGroupRepositoryInterface $attributeGroupRepository,
        $attributeSetId
    ) {
        $this->attributeGroupRepository = $attributeGroupRepository;
        $this->initFieldsMap($attributeCollectionFactory, $attributeSetId);
    }

    /**
     * Attribute collection for the current mapper.
     *
     * @return \Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection
     */
    public function getAttributesCollection()
    {
        return $this->attributesCollection;
    }

    /**
     * Mapping of the attribute by fieldsets.
     *
     * @return string[]
     */
    public function getFieldsMap()
    {
        return $this->fieldsMap;
    }

    /**
     * Fielset properties.
     *
     * @return array
     */
    public function getFieldsets()
    {
        return $this->fieldsets;
    }

    /**
     * Fields map initialization
     *
     * @param AttributeCollectionFactory $attributeCollectionFactory
     * @param $attributeSetId
     * @return $this
     */
    private function initFieldsMap(AttributeCollectionFactory $attributeCollectionFactory, $attributeSetId)
    {
        $this->fieldsMap            = [];
        $this->attributesCollection = $attributeCollectionFactory->create();
        $this->attributesCollection->setAttributeSetFilterBySetName($attributeSetId, DataInterface::ENTITY);
        $this->attributesCollection->addSetInfo();

        foreach ($this->attributesCollection as $attribute) {
            $attributeGroupId  = $attribute->getAttributeGroupId();
            $attributeGroup    = $this->attributeGroupRepository->get($attributeGroupId);
            $fieldsetCode      = str_replace('-', '_', $attributeGroup->getAttributeGroupCode());
            $this->fieldsets[$fieldsetCode] = ['name' => $attributeGroup->getAttributeGroupName(), 'sortOrder' => $attributeGroup->getSortOrder()];
            $this->fieldsMap[$fieldsetCode][] = $attribute->getAttributeCode();
        }

        return $this;
    }
}

