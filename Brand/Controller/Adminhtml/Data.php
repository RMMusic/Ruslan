<?php
/**
 * Ruslan Miskiv
 *
 * Ruslan_Brand module Brand action
 */

namespace Ruslan\Brand\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Ruslan\Brand\Api\DataRepositoryInterface;

abstract class Data extends Action
{
    /**
     * @var string
     */
    const ACTION_RESOURCE = 'Ruslan_Brand::data';

    /**
     * Data repostory
     *
     * @var DataRepositoryInterface
     */
    protected $_dataRepository;

    /**
     * Core registry
     *
     * @var Registry
     */

    protected $_coreRegistry;

    /**
     * Result Page Factory
     *
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Result Forward Factory
     *
     * @var ForwardFactory
     */
    protected $_resultForwardFactory;

    /**
     * Data constructor.
     *
     * @param Registry $registry
     * @param DataRepositoryInterface $dataRepository
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $resultForwardFactory
     * @param Context $context
     */
    public function __construct(
        Registry $registry,
        DataRepositoryInterface $dataRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Context $context

    ) {
        $this->_coreRegistry         = $registry;
        $this->_dataRepository       = $dataRepository;
        $this->_resultPageFactory    = $resultPageFactory;
        $this->_resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }
}
