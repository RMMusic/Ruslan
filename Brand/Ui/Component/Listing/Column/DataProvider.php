<?php

/**
 * @author Ruslan Miskiv
 *
 * Ruslan_Brand module provider
 */

namespace Ruslan\Brand\Ui\Component\Listing\Column;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory;

/**
 * Class DataProvider
 * @package Ruslan\Brand\Model
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var \Ruslan\Brand\Model\ResourceModel\Data\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $pageCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $pageCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection    = $pageCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->meta           = $this->prepareMeta($this->meta);
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getConnection();
        foreach ($items as $page) {
            $this->loadedData[$page->getId()] = $page->getData();
        };
        $data = $this->dataPersistor->get('module_messages');
        if (!empty($data)) {
            $page = $this->collection->getNewEmptyItem();
            $page->setData($data);
            $this->loadedData[$page->getId()] = $page->getData();
            $this->dataPersistor->clear('module_messages');
        }
        return $this->loadedData;
    }
}
