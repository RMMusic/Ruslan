<?php

/**
 * @author Ruslan Miskiv
 *
 * Ruslan_Brand module interface
 */

namespace Ruslan\Brand\Api\Data;

/**
 * Interface DataInterface
 * @package Ruslan\Brand\Api\Data
 */
interface DataInterface
{
    /**
     * Constants for keys of data array
     */
    const ID                = 'entity_id';
    const NAME              = 'name';
    const DESCRIPTION       = 'description';
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
     * Get Name
     *
     * @return string
     */
    public function getName();

    /**
     * Set Name
     *
     * @param $title
     * @return mixed
     */
    public function setName($title);

    /**
     * Get Description
     *
     * @return mixed
     */
    public function getDescription();

    /**
     * Set Description
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
