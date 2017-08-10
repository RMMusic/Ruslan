<?php
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Brand model
 */

namespace Ruslan\Brand\Model;

use Magento\Framework\Model\AbstractModel;
use Ruslan\Brand\Api\Data\DataInterface;

class Data extends AbstractModel implements DataInterface
{

    /**
     * Entity code.
     */
    const ENTITY = 'ruslan_brand';

    /**
     * Cache tag
     */
    const CACHE_TAG = 'ruslan_brand';

    /**
     * Initialise resource model
     */
    protected function _construct()
    {
        $this->_init('Ruslan\Brand\Model\ResourceModel\Data');
    }

    /**
     * Get cache identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(DataInterface::DATA_TITLE);
    }

    /**
     * Set title
     *
     * @param $title
     * @return $this
     */
    public function setName($title)
    {
        return $this->setData(DataInterface::DATA_TITLE, $title);
    }

    /**
     * Get data description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getData(DataInterface::DATA_TITLE);
    }

    /**
     * Set data description
     *
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setData(DataInterface::DATA_DESCRIPTION, $description);
    }

    /**
     * Get is active
     *
     * @return bool|int
     */
    public function getIsActive()
    {
        return $this->getData(DataInterface::IS_ACTIVE);
    }

    /**
     * Set is active
     *
     * @param $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        return $this->setData(DataInterface::IS_ACTIVE, $isActive);
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->getData(DataInterface::IMAGE);
    }
    /**
     * Set image
     *
     * @param $image
     * @return $this
     */
    public function setImage($image)
    {
        return $this->setData(DataInterface::IMAGE, $image);
    }

}
