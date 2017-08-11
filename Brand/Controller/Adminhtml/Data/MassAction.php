<?php

/**
 * @author Ruslan Miskiv
 *
 * Ruslan_Brand module Mass action
 */

namespace Ruslan\Brand\Controller\Adminhtml\Data;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Ui\Component\MassAction\Filter;
use Ruslan\Brand\Api\DataRepositoryInterface;
use Ruslan\Brand\Controller\Adminhtml\Data;
use Ruslan\Brand\Model\Data as DataModel;
use Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory;

/**
 * Class MassAction
 * @package Ruslan\Brand\Controller\Adminhtml\Data
 */
abstract class MassAction extends Data
{
    /**
     * @var Filter
     */
    protected $_filter;

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @var DataRepositoryInterface
     */
    protected $_dataRepository;

    /**
     * @var ForwardFactory
     */
    protected $_resultForwardFactory;
    /**
     * @var string
     */
    protected $_successMessage;
    /**
     * @var string
     */
    protected $_errorMessage;

    /**
     * MassAction constructor.
     *
     * @param Filter $filter
     * @param Registry $registry
     * @param DataRepositoryInterface $dataRepository
     * @param PageFactory $resultPageFactory
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param ForwardFactory $resultForwardFactory
     * @param $successMessage
     * @param $errorMessage
     */
    public function __construct(
        Filter $filter,
        Registry $registry,
        DataRepositoryInterface $dataRepository,
        PageFactory $resultPageFactory,
        Context $context,
        CollectionFactory $collectionFactory,
        ForwardFactory $resultForwardFactory,
        $successMessage,
        $errorMessage
    ) {
        $this->_filter               = $filter;
        $this->_dataRepository       = $dataRepository;
        $this->_collectionFactory    = $collectionFactory;
        $this->_resultForwardFactory = $resultForwardFactory;
        $this->_successMessage       = $successMessage;
        $this->_errorMessage         = $errorMessage;
        parent::__construct($registry, $dataRepository, $resultPageFactory, $resultForwardFactory, $context);
    }

    /**
     * @param DataModel $data
     * @return mixed
     */
    protected abstract function massAction(DataModel $data);

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection as $data) {
                $this->massAction($data);
            }
            $this->messageManager->addSuccessMessage(__($this->_successMessage, $collectionSize));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __($this->_errorMessage));
        }
        $redirectResult = $this->resultRedirectFactory->create();
        $redirectResult->setPath('brand/data/index');
        return $redirectResult;
    }
}
