<?php

/**
 * @author Ruslan Miskiv
 *
 * Ruslan_Brand module Mass enable action
 */

namespace Ruslan\Brand\Controller\Adminhtml\Data;

use Ruslan\Brand\Model\Data;

/**
 * Class MassEnable
 * @package Ruslan\Brand\Controller\Adminhtml\Data
 */
class MassEnable extends MassAction
{
    /**
     * @param Data $data
     * @return $this
     */
    protected function massAction(Data $data)
    {
        $data->setIsActive(true);
        $this->_dataRepository->save($data);
        return $this;
    }
}
