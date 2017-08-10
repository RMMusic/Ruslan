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

class Brand extends AbstractSource implements OptionSourceInterface
{
    /**
     * @var \Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @var array|null
     */
    protected $_options;

    /**
     * @param \Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->_collectionFactory = $collectionFactory;
    }

    /**
     * Prepare data for options
     *
     * @return array
     */
    public function toOptionArray() {
        if ($this->_options === null) {
            $collection = $this->_collectionFactory->create()->addAttributeToSelect('*');

            $this->_options = [];

            foreach ($collection as $item) {
                $this->_options[] = [
                    'label' => $item->getData('name'),
                    'value' => $item->getData('entity_id')
                ];
            }
        }
        return $this->_options;
    }

    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        return $this->toOptionArray();
        $collection = $this->_collectionFactory->create()->addAttributeToSelect('*');
//        var_dump($collection->getFirstItem()->getData());
//        die();
        $options = [];
        foreach ($this->toOptionArray() as $option)
        {
            $options[] = [
                'label' => $option['label'],
                'value' => $option['value']
            ];
        }

        return $options;
    }
}
