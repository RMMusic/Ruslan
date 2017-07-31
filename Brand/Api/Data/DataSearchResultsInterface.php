<?php
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Brand search result interface
 */

namespace Ruslan\Brand\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface DataSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get data list.
     *
     * @return \Ruslan\Brand\Api\Data\DataInterface[]
     */
    public function getItems();

    /**
     * Set data list.
     *
     * @param \Ruslan\Brand\Api\Data\DataInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}