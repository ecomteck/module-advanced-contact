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
namespace Ecomteck\AdvancedContact\Controller\Form;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Post
 * @package Ecomteck\AdvancedContact\Controller\Form
 */
class Post extends Action
{
    /**
     * Execute method
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $validator = $this->_objectManager->get(\Magento\Framework\Data\Form\FormKey\Validator::class);
        if ($validator->validate($this->getRequest())) {
            $helper = $this->_objectManager->get(\Ecomteck\AdvancedContact\Helper\Data::class);
            $json = $this->_objectManager->get(\Magento\Framework\Serialize\Serializer\Json::class);
            $store = $this->_objectManager->get(\Magento\Store\Model\StoreManagerInterface::class)->getStore();
            $fields = $helper->getConfig('advanced_contact/fields', $store->getId());
            $fields = $json->unserialize($fields);
            $info = [];
            if (count($fields)>0) {
                foreach ($fields as $field) {
                    try {
                        if ($this->getRequest()->getParam($field['key'])) {
                            $info[] = [
                                'key' => $field['key'],
                                'label' => $field['label'],
                                'type' => $field['field_type'],
                                'value' => $this->getRequest()->getParam($field['key'])
                            ];
                        }
                    } catch (\Exception $e) {

                    }
                }
            }
            if (count($info)>0) {
                $model = $this->_objectManager->get(\Ecomteck\AdvancedContact\Model\Request::class);
                $model->setData('info', $json->serialize($info));
                try {
                    $model->save();
                    if ($model->getId()) {
                        $email = $this->_objectManager->get(\Ecomteck\AdvancedContact\Helper\Email::class);
                        $email->recive($model, $store->getId());
                        $messageManager = $this->_objectManager
                            ->get(\Magento\Framework\Message\ManagerInterface::class);
                        $messageManager->addSuccess(__('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.'));
                    }
                } catch (\Exception $e) {

                }
            }
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
