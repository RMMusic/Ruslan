<?php

namespace Ruslan\Brand\Ui\Component\Listing;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\EavValidationRules;
use Magento\Eav\Api\Data\AttributeInterface;

/**
 * Class DataProvider
 * @package Socoda\Company\Ui\Component\Company\Form
 */
class FormDataProvider extends AbstractDataProvider
{
    /**
     * Image attribute code.
     */
    const IMAGE_ATTRIBUTE_CODE = 'image';

    /**
     * Company media folder name.
     */
    const COMPANY_MEDIA_PATH_PART = 'company';

    /**
     * EAV attribute properties to fetch from meta storage
     *
     * @var array
     */
    private $metaProperties = [
        'formElement' => 'frontend_input',
        'required'    => 'is_required',
        'label'       => 'frontend_label',
        'sortOrder'   => 'sort_order',
        'notice'      => 'note',
        'default'     => 'default_value',
        'size'        => 'multiline_count',
    ];

    /**
     * Form element mapping
     *
     * @var array
     */
    private $formElement = [
        'text'    => 'input',
        'boolean' => 'checkbox',
    ];

    /**
     * Collection factory
     *
     * @var mixed
     */
    private $collectionFactory;

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Eav validation rules
     *
     * @var EavValidationRules
     */
    private $eavValidationRules;

    /**
     * Field mapper
     *
     * @var FieldMapper
     */
    private $fieldMapper;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $collectionFactory
     * @param StoreManagerInterface $storeManager
     * @param EavValidationRules $eavValidationRules
     * @param FieldMapper $fieldMapper
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        $collectionFactory,
        StoreManagerInterface $storeManager,
        EavValidationRules $eavValidationRules,
        FieldMapper $fieldMapper,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collectionFactory    = $collectionFactory;
        $this->storeManager         = $storeManager;
        $this->eavValidationRules   = $eavValidationRules;
        $this->fieldMapper          = $fieldMapper;
        $this->meta                 = $this->prepareMeta($meta);
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        $data = parent::getData();
        foreach ($data as &$item) {
            if (!empty($item[self::IMAGE_ATTRIBUTE_CODE])) {
                $filename = $item[self::IMAGE_ATTRIBUTE_CODE];
                $url = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
                    .self::COMPANY_MEDIA_PATH_PART . DIRECTORY_SEPARATOR . $filename;

                unset($item[self::IMAGE_ATTRIBUTE_CODE]);
                $item[self::IMAGE_ATTRIBUTE_CODE][0]['name'] = $filename;
                $item[self::IMAGE_ATTRIBUTE_CODE][0]['url'] = $url;
            }
        }

        return $data;

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function getCollection()
    {
        if ($this->collection === null) {
            $this->collection = $this->collectionFactory->create();
            $this->collection->addAttributeToSelect('*');
        }

        return $this->collection;
    }

    /**
     * Get default scope label.
     *
     * @return \Magento\Framework\Phrase
     */
    public function getDefaultScopeLabel()
    {
        return __('[GLOBAL]');
    }

    /**
     * Prepare meta data.
     *
     * @param array $meta The meta data.
     *
     * @return array
     */
    private function prepareMeta($meta)
    {
        $meta = array_replace_recursive($meta, $this->prepareFieldsMeta($this->getFieldsMap(), $this->getAttributesMeta()));

        return $meta;
    }

    /**
     * Get attributes meta.
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     * @return array
     */
    private function getAttributesMeta()
    {
        $meta   = [];

        foreach ($this->getAttributes()->getItems() as $attribute) {
            $code = $attribute->getAttributeCode();
            foreach ($this->metaProperties as $metaName => $origName) {
                $value = $attribute->getDataUsingMethod($origName);

                $meta[$code][$metaName] = $value;

                if ('frontend_input' === $origName) {
                    $meta[$code]['formElement'] = isset($this->formElement[$value]) ? $this->formElement[$value] : $value;
                }
                if ($attribute->usesSource()) {
                    $meta[$code]['options'] = $attribute->getSource()->getAllOptions();
                }
            }

            $rules = $this->eavValidationRules->build($attribute, $meta[$code]);
            if (!empty($rules)) {
                $meta[$code]['validation'] = $rules;
            }

            $meta[$code]['scopeLabel']    = $this->getScopeLabel($attribute);
            $meta[$code]['componentType'] = \Magento\Ui\Component\Form\Field::NAME;
        }

        return $meta;
    }

    /**
     * List of EAV attributes of the current model.
     *
     * @return \Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection
     */
    private function getAttributes()
    {
        return $this->fieldMapper->getAttributesCollection();
    }

    /**
     * Retrieve label of attribute scope
     *
     * GLOBAL | WEBSITE | STORE
     *
     * @param mixed $attribute The attribute.
     *
     * @return string
     */
    private function getScopeLabel($attribute)
    {
        $html = '';
        if (!$attribute || $this->storeManager->isSingleStoreMode()
            || $attribute->getFrontendInput() === AttributeInterface::FRONTEND_INPUT
        ) {
            return $html;
        }

        if ($attribute->isScopeGlobal()) {
            $html .= __('[GLOBAL]');
        } elseif ($attribute->isScopeWebsite()) {
            $html .= __('[WEBSITE]');
        } elseif ($attribute->isScopeStore()) {
            $html .= __('[STORE VIEW]');
        }

        return $html;
    }

    /**
     * Field map by fielset code.
     *
     * @return array
     */
    private function getFieldsMap()
    {
        return $this->fieldMapper->getFieldsMap();
    }

    /**
     * Prepare fields meta based on xml declaration of form and fields metadata
     *
     * @param array $fieldsMap  The field Map
     * @param array $fieldsMeta The fields meta
     *
     * @return array
     */
    private function prepareFieldsMeta($fieldsMap, $fieldsMeta)
    {
        $result    = [];
        $fieldsets = $this->fieldMapper->getFieldsets();

        foreach ($fieldsMap as $fieldSet => $fields) {
            foreach ($fields as $field) {
                if (!isset($result[$fieldSet])) {
                    $result[$fieldSet]['arguments']['data']['config'] = [
                        'componentType' => \Magento\Ui\Component\Form\Fieldset::NAME,
                        'label'         => $fieldsets[$fieldSet]['name'],
                        'sortOrder'     => $fieldsets[$fieldSet]['sortOrder'],
                        'collapsible'   => true,
                    ];
                }

                if (isset($fieldsMeta[$field])) {
                    $result[$fieldSet]['children'][$field]['arguments']['data']['config'] = $fieldsMeta[$field];
                }
            }
        }

        return $result;
    }
}

