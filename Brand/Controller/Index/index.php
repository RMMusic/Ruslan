<?php
/**
 * Module Enter's controller
 *
 * @author Ruslan Miskiv
 */
namespace Ruslan\Brand\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Ruslan\Brand\Model\DataFactory;
use Ruslan\Brand\Model\ResourceModel\Data\CollectionFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $baseFactory;
    protected $_resultPageFactory;
    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DataFactory $baseFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->baseFactory = $baseFactory;
        parent::__construct($context);
    }
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $this->set();
        return $resultPage;
    }




///**
// * Block Enter
// *
// * @author Ruslan Miskiv
// */
//namespace Test\Enter\Block;
//use Magento\Framework\View\Element\Template;
//use Magento\Framework\View\Element\Template\Context;
//use MagDev\Enter\Model\BaseFactory;
//
//class Enter extends Template
//{
//    /**
//     * Base model
//     * @var BaseFactory
//     */
//    protected $baseFactory;
//    /**
//     * Enter constructor.
//     * @param Context $context
//     * @param BaseFactory $baseFactory
//     */
//    public function __construct(
//        Context $context,
//        BaseFactory $baseFactory)
//    {
//        $this->baseFactory = $baseFactory;
//        return parent::__construct($context);
//    }
//    /**
//     * Collection for template
//     *
//     * @return data from collection
//     */
    public function set()
    {
        $base = $this->baseFactory->create();
        $base->setEntityId(5);
        $base->setName('ruslan6');
        $base->setDescription('11description');
        $base->setImage('image1');
        $base->setIs_active(0);
        $base->save();
        $baseCollection = $base->getCollection()->addAttributeToSelect('*');
        foreach ($baseCollection as $item) {
            var_dump($item->getData());
        }
        die();
    }

//    public function getTxt()
//    {
//        $base = $this->baseFactory->create();
//        $baseCollection = $base->getCollection();
//        foreach ($baseCollection as $item) {
//            var_dump($item->getData());
//        }
//    }
}