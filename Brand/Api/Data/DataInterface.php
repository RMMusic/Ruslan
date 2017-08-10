<?php
namespace Ruslan\Brand\Api\Data;
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Brand interface
 */

interface DataInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const DATA_ID           = 'entity_id';
    const DATA_TITLE        = 'name';
    const DATA_DESCRIPTION  = 'description';
    const IS_ACTIVE         = 'is_active';
    const IMAGE             = 'image';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param $id
     * @return DataInterface
     */
    public function setId($id);

    /**
     * Get Data Title
     *
     * @return string
     */
    public function getName();

    /**
     * Set Data Title
     *
     * @param $title
     * @return mixed
     */
    public function setName($title);

    /**
     * Get Data Description
     *
     * @return mixed
     */
    public function getDescription();

    /**
     * Set Data Description
     *
     * @param $description
     * @return mixed
     */
    public function setDescription($description);

    /**
     * Get is active
     *
     * @return bool|int
     */
    public function getIsActive();

    /**
     * Set is active
     *
     * @param $isActive
     * @return DataInterface
     */
    public function setIsActive($isActive);

    /**
     * Get image
     *
     * @return string
     */
    public function getImage();

    /**
     * Set image
     *
     * @param $image
     * @return DataInterface
     */
    public function setImage($image);
}
