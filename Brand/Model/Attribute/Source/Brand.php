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
            $collection = $this->_collectionFactory->create();

            $this->_options = [];

            foreach ($collection as $category) {
                $this->_options[] = [
                    'label' => $category->getData('data_title'),
                    'value' => $category->getData('data_id')
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
