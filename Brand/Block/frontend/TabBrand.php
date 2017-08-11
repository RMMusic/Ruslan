<?php

/**
 * Brand Tab Block
 *
 * @author Ruslan Miskiv
 */

namespace Ruslan\Brand\Block\frontend;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory;

class TabBrand extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * TabBrand constructor.
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        Registry $registry,
        array $data = [])
    {
        $this->collectionFactory = $collectionFactory;
        $this->registry = $registry;
        return parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function getCurrentProduct()
    {
        $brand = $this->registry->registry('current_product');
        if (!$brand->getCustomAttribute('add_brand_to_product')) {
            return false;
        }

        return $brand->getCustomAttribute('add_brand_to_product')->getValue();
    }

    /**
     * @return bool
     */
    public function getBrand()
    {
        if (!$this->getCurrentProduct()) {
            return false;
        }

        $item = $this->collectionFactory->create()->addAttributeToSelect('*');
        $brand = $item->getItemById($this->getCurrentProduct());

        if (!$brand->getIs_active()) {
            return false;
        }
        return $brand->getName();
    }
}
