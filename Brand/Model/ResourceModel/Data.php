<?php
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Brand resource model
 */

namespace Ruslan\Brand\Model\ResourceModel;

use Magento\Catalog\Model\ResourceModel\AbstractResource;

/**
 * Brand entity resource model
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Data extends AbstractResource
{
    /**
     * Entity type getter and lazy loader
     *
     * @return \Magento\Eav\Model\Entity\Type
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(\Ruslan\Brand\Model\Data::ENTITY);
        }
        return parent::getEntityType();
    }
}
