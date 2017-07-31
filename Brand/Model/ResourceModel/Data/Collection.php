<?php
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Brand collection model
 */

namespace Ruslan\Brand\Model\ResourceModel\Data;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'data_id';

    /**
     * Collection initialisation
     */
    protected function _construct()
    {
        $this->_init('Ruslan\Brand\Model\Data','Ruslan\Brand\Model\ResourceModel\Data');
    }
}
