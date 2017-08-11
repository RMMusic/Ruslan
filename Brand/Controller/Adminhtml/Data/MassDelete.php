<?php

/**
 * @author Ruslan Miskiv
 *
 * Ruslan_Brand module Mass delete action
 */

namespace Ruslan\Brand\Controller\Adminhtml\Data;

use Ruslan\Brand\Model\Data;

/**
 * Class MassDelete
 * @package Ruslan\Brand\Controller\Adminhtml\Data
 */
class MassDelete extends MassAction
{
    /**
     * @param Data $data
     * @return $this
     */
    protected function massAction(Data $data)
    {
        $this->_dataRepository->delete($data);
        return $this;
    }
}
