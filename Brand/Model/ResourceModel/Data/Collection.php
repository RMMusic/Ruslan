<?php

/**
 * @author Ruslan Miskiv
 *
 * Ruslan_Brand module Brand collection model
 */

namespace Ruslan\Brand\Model\ResourceModel\Data;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Ruslan\Brand\Model\ResourceModel\Data
 */
class Collection extends AbstractCollection
{
    /**
     * @var $_dataCollectionFactory
     */
    protected $_dataCollectionFactory;

    /**
     *  init method
     */
    protected function _construct()
    {
        $this->_init('Ruslan\Brand\Model\Data', 'Ruslan\Brand\Model\ResourceModel\Data');
    }
}
