<?php

/**
 * @author Ruslan Miskiv
 *
 * Ruslan_Brand module resource model
 */

namespace Ruslan\Brand\Model\ResourceModel;

use Magento\Catalog\Model\ResourceModel\AbstractResource;

/**
 * Class Data
 * @package Ruslan\Brand\Model\ResourceModel
 */
class Data extends AbstractResource
{
    /**
     * Entity type getter and lazy loader
     *
     * @return \Magento\Eav\Model\Entity\Type
     */
    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(\Ruslan\Brand\Model\Data::ENTITY);
        }
        return parent::getEntityType();
    }
}
