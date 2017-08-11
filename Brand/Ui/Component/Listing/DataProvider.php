<?php

/**
 * @author Ruslan Miskiv
 *
 * Grid data provider
 */

namespace Ruslan\Brand\Ui\Component\Listing;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory;
use Magento\Framework\Api\Filter;

/**
 * Class DataProvider
 * @package Ruslan\Brand\Ui\Component\Listing
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var \Ruslan\Brand\Model\ResourceModel\Data\Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $addFieldStrategies;

    /**
     * @var array
     */
    protected $addFilterStrategies;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $addFieldStrategies
     * @param array $addFilterStrategies
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $addFieldStrategies = [],
        array $addFilterStrategies = [],
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->addFieldStrategies  = $addFieldStrategies;
        $this->addFilterStrategies = $addFilterStrategies;
    }
    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!$this->getCollection()->addAttributeToSelect('*')->isLoaded()) {
            $this->getCollection()->load();
        }
        $items = $this->getCollection()->addAttributeToSelect('*')->toArray();
        return [
            'totalRecords' => $this->getCollection()->getSize(),
            'items'        => array_values($items),
        ];
    }

    /**
     * Add field
     *
     * @param array|string $field
     * @param null $alias
     */
    public function addField($field, $alias = null)
    {
        if (isset($this->addFieldStrategies[$field])) {
            $this->addFieldStrategies[$field]->addField($this->getCollection(), $field, $alias);
            return ;
        }
        parent::addField($field, $alias);
    }

    /**
     * @param \Magento\Framework\Api\Filter $filter
     */
    public function addFilter(Filter $filter)
    {
        if (isset($this->addFilterStrategies[$filter->getField()])) {
            $this->addFilterStrategies[$filter->getField()]
                ->addFilter(
                    $this->getCollection(),
                    $filter->getField(),
                    [$filter->getConditionType() => $filter->getValue()]
                );
            return;
        }
        parent::addFilter($filter);
    }
}
