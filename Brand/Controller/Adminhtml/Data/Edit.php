<?php
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Edit action
 */

namespace Ruslan\Brand\Controller\Adminhtml\Data;

use Ruslan\Brand\Controller\Adminhtml\Data;

class Edit extends Data
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $dataId = $this->getRequest()->getParam('entity_id');
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Ruslan_Brand::data')
            ->addBreadcrumb(__('Data'), __('Data'))
            ->addBreadcrumb(__('Manage Data'), __('Manage Data'));

        if ($dataId === null) {
            $resultPage->addBreadcrumb(__('New brand'), __('New brand'));
            $resultPage->getConfig()->getTitle()->prepend(__('New brand'));
        } else {
            $resultPage->addBreadcrumb(__('Edit brand'), __('Edit brand'));
            $resultPage->getConfig()->getTitle()->prepend(
                $this->_dataRepository->getById($dataId)->getN()
            );
        }
        return $resultPage;
    }
}
