<?php
/**
 * Copyright © Elogic.
 * 2020.09.22
 */
namespace Elogic\Vendor\Controller\Adminhtml\Vendors;

use Elogic\Vendor\Model\Vendor;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action {
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;
    /**
     * @var Vendor
     */
    private $vendor;

    /**
     * Delete constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Vendor $vendor
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Vendor $vendor
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->vendor = $vendor;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute(){
        $id = $this->getRequest()->getParam('id');
        if($id>0){
            try {
                $vendor = $this->vendor->load($id);
                try {
                    $vendor->delete($vendor);
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage(__('Something went wrong when deleting vendor.'));
                }
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('ID with such vendor not found.'));
            }
        }
        $this->_redirect('vendor/vendors');
    }
}