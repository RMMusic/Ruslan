<?php

/**
 * @author Ruslan Miskiv
 *
 * Ruslan_Brand module Brand repository interface
 */

namespace Ruslan\Brand\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Ruslan\Brand\Api\Data\DataInterface;

/**
 * Interface DataRepositoryInterface
 * @package Ruslan\Brand\Api
 */
interface DataRepositoryInterface
{

    /**
     * @param DataInterface $data
     * @return mixed
     */
    public function save(DataInterface $data);


    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Ruslan\Brand\Api\Data\DataSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param DataInterface $data
     * @return mixed
     */
    public function delete(DataInterface $data);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}
