<?php

/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Mass disable action
 */

namespace Ruslan\Brand\Controller\Adminhtml\Data;

use Ruslan\Brand\Model\Data;

/**
 * Class MassDisable
 * @package Ruslan\Brand\Controller\Adminhtml\Data
 */
class MassDisable extends MassAction
{
    /**
     * @param Data $data
     * @return $this
     */
    protected function massAction(Data $data)
    {
        $data->setIsActive(false);
        $this->_dataRepository->save($data);
        return $this;
    }
}
