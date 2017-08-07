<?php
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Brand collection model
 */

namespace Ruslan\Brand\Model\ResourceModel\Data;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_dataCollectionFactory;


//    public function __construct(
//        \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
//        \Psr\Log\LoggerInterface $logger,
//        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
//        \Magento\Framework\Event\ManagerInterface $eventManager,
//        \Magento\Eav\Model\Config $eavConfig,
//        \Magento\Framework\App\ResourceConnection $resource,
//        \Magento\Eav\Model\EntityFactory $eavEntityFactory,
//        \Magento\Catalog\Model\ResourceModel\Helper $resourceHelper,
//        \Magento\Framework\Validator\UniversalFactory $universalFactory,
//        \Magento\Store\Model\StoreManagerInterface $storeManager,
//        \Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory $dataCollectionFactory,
//        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null
//    ) {
//        $this->_brandCollectionFactory = $dataCollectionFactory;
//        parent::__construct(
//            $entityFactory,
//            $logger,
//            $fetchStrategy,
//            $eventManager,
//            $eavConfig,
//            $resource,
//            $eavEntityFactory,
//            $resourceHelper,
//            $universalFactory,
//            $storeManager,
//            $connection
//        );
//    }

    protected function _construct()
    {
        $this->_init('Ruslan\Brand\Model\Data', 'Ruslan\Brand\Model\ResourceModel\Data');
    }
}
