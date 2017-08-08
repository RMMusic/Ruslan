<?php


namespace Ruslan\Brand\Ui\Component\Listing;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory;

/**
 * Class DataProvider
 * @package Socoda\Company\Ui\Component\Company\Listing
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * Company collection
     *
     * @var \Socoda\Company\Model\ResourceModel\Company\Collection
     */
    protected $collection;

    /**
     * Add field strategies
     *
     * @var \Magento\Ui\DataProvider\AddFieldToCollectionInterface[]
     */
    protected $addFieldStrategies;

    /**
     * Add filter strategies
     *
     * @var \Magento\Ui\DataProvider\AddFilterToCollectionInterface[]
     */
    protected $addFilterStrategies;

    /**
     * DataProvider constructor.
     *
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
     * {@inheritdoc}
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
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
