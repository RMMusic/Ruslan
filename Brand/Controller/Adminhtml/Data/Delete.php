<?php
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Delete action
 */

namespace Ruslan\Brand\Controller\Adminhtml\Data;

use Ruslan\Brand\Controller\Adminhtml\Data;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class Delete extends Data
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $dataId = $this->getRequest()->getParam('data_id');
        if ($dataId) {
            try {
                $this->_dataRepository->deleteById($dataId);
                $this->messageManager->addSuccessMessage(__('The data has been deleted.'));
                $resultRedirect->setPath('brand/data/index');
                return $resultRedirect;
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('The data no longer exists.'));
                return $resultRedirect->setPath('brand/data/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('brand/data/index', ['data_id' => $dataId]);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('There was a problem deleting the data'));
                return $resultRedirect->setPath('brand/data/edit', ['data_id' => $dataId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find the data to delete.'));
        $resultRedirect->setPath('brand/data/index');
        return $resultRedirect;
    }
}
