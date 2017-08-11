<?php

/**
 * @author Ruslan Miskiv
 *
 * Attribute Model
 */

namespace Ruslan\Brand\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Data\OptionSourceInterface;
use Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory;

/**
 * Class Brand
 * @package Ruslan\Brand\Model\Attribute\Source
 */
class Brand extends AbstractSource implements OptionSourceInterface
{
    /**
     * @var \Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var array|null
     */
    protected $options;

    /**
     * Brand constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->options = null;
        $this->options = [];
        $collection = $this->collectionFactory->create()->addAttributeToSelect('*');

        foreach ($collection as $item) {
            $this->options[] = [
                'label' => $item->getData('name'),
                'value' => $item->getData('entity_id')
            ];
        }

        return $this->options;
    }
}
