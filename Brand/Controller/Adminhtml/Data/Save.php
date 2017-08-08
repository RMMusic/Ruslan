<?php
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Save action
 */

namespace Ruslan\Brand\Controller\Adminhtml\Data;

use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Message\Manager;
use Magento\Framework\Api\DataObjectHelper;
use Ruslan\Brand\Api\DataRepositoryInterface;
use Ruslan\Brand\Api\Data\DataInterface;
use Ruslan\Brand\Api\Data\DataInterfaceFactory;
use Ruslan\Brand\Controller\Adminhtml\Data;

class Save extends Data
{
    /**
     * @var Manager
     */
    protected $_messageManager;

    /**
     * @var DataRepositoryInterface
     */
    protected $_dataRepository;

    /**
     * @var DataInterfaceFactory
     */
    protected $_dataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $_dataObjectHelper;


    public function __construct(
        Registry $registry,
        DataRepositoryInterface $dataRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Manager $messageManager,
        DataInterfaceFactory $dataFactory,
        DataObjectHelper $dataObjectHelper,
        Context $context
    )
    {
        $this->_messageManager   = $messageManager;
        $this->_dataFactory      = $dataFactory;
        $this->_dataRepository   = $dataRepository;
        $this->_dataObjectHelper  = $dataObjectHelper;
        parent::__construct($registry, $dataRepository, $resultPageFactory, $resultForwardFactory, $context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                $model = $this->_dataRepository->getById($id);
            } else {
                unset($data['entity_id']);
                $model = $this->_dataFactory->create();
            }
            try {
                $this->_dataObjectHelper->populateWithArray($model, $data, DataInterface::class);
                $this->_dataRepository->save($model);
                $this->_messageManager->addSuccessMessage(__('You saved this data.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['entity_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->_messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->_messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->_messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
