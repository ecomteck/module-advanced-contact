<?php
/**
 * Ecomteck
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Ecomteck.com license that is
 * available through the world-wide-web at this URL:
 * https://www.ecomteck.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Ecomteck
 * @package     Ecomteck_AdvancedContact
 * @copyright   Copyright (c) Ecomteck (https://www.ecomteck.com/)
 * @license     https://www.ecomteck.com/LICENSE.txt
 */
namespace Ecomteck\AdvancedContact\Controller\Adminhtml\Requests;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

/**
 * Class Save
 * @package Ecomteck\AdvancedContact\Controller\Adminhtml\Requests
 */
class Save extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * result page variable
     */
    protected $_resultPage;

    /**
     * Save constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('contact_id');
        $model = $this->_objectManager->create(\Ecomteck\AdvancedContact\Model\Request::class);
        if ($id) {
            $model->load($id);
        }
        $model->setData($data);
        try {
            $model->save();
            $this->messageManager->addSuccess(__('Saved.'));
            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['contact_id' => $model->getId(), '_current' => true]);
            }
            $this->_objectManager->get(\Magento\Backend\Model\Session::class)->setFormData(false);
            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong.'));
        }
        $this->_getSession()->setFormData($data);
        return $resultRedirect->setPath('*/*/edit', ['contact_id' => $this->getRequest()->getParam('contact_id')]);
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ecomteck_AdvancedContact::request_save');
    }
}
