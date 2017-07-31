<?php
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Add action
 */

namespace Ruslan\Brand\Controller\Adminhtml\Data;

use Ruslan\Brand\Controller\Adminhtml\Data;

class Add extends Data
{
    /**
     * Forward to edit
     */
    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
