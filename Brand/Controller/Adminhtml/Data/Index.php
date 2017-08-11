<?php

/**
 * @author Ruslan Miskiv
 *
 * Ruslan_Brand module Index action
 */


namespace Ruslan\Brand\Controller\Adminhtml\Data;

use Ruslan\Brand\Controller\Adminhtml\Data;

/**
 * Class Index
 * @package Ruslan\Brand\Controller\Adminhtml\Data
 */
class Index extends Data
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->_resultPageFactory->create();
    }
}
