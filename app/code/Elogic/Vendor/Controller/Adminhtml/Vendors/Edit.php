<?php
/**
 * Copyright © Elogic.
 * 2020.09.22
 */
namespace Elogic\Vendor\Controller\Adminhtml\Vendors;
use Elogic\Vendor\Model\Vendor;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var Vendor
     */
    private $vendor;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Vendor $vendor
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Vendor $vendor
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        $this->vendor = $vendor;
    }

    /**
     * @return bool
     */
    protected function _isAllowed(){
        return $this->_authorization->isAllowed('Elogic_Vendor::vendor_save');
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    protected function _initAction(){
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Elogic_Vendor::vendors')
            ->addBreadcrumb(__('Vendors'), __('Vendors'))
            ->addBreadcrumb(__('Edit'), __('Edit'));
        return $resultPage;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $vendor = $this->vendor;

        if ($id > 0) {
            try {
                $vendor = $this->vendor->load($id);
                if (!$vendor->getId()) {
                    $this->messageManager->addErrorMessage(__('This vendor doesn\'t exists.'));
                    $resultRedirect = $this->resultRedirectFactory->create();

                    return $resultRedirect->setPath('*/*/');
                }
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('ID with such vendor not found.'));
            }
        }

        $resultPage = $this->_initAction();

        $resultPage->addBreadcrumb(
            $id ? __('Edit Vendor') : __('New Vendor'),
            $id ? __('Edit Vendor') : __('New Vendor')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Vendors'));
        $resultPage->getConfig()->getTitle()
            ->prepend($vendor->getId() ? $vendor->getName() : __('New Vendor'));

        return $resultPage;
    }
}