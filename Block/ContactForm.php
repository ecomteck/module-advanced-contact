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
namespace Ecomteck\AdvancedContact\Block;

/**
 * Class ContactForm
 * @package Ecomteck\AdvancedContact\Block
 */
class ContactForm extends \Magento\Contact\Block\ContactForm
{
    /**
     * @var
     */
    private $_fields;

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getFields()
    {
        if (!$this->_fields) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $helper = $objectManager->get(\Ecomteck\AdvancedContact\Helper\Data::class);
            $json = $objectManager->get(\Magento\Framework\Serialize\Serializer\Json::class);
            $fields = $helper->getConfig(
                'advanced_contact/fields',
                $this->_storeManager->getStore()->getId()
            );
            $fields = $json->unserialize($fields);
            if (count($fields)>0) {
                foreach ($fields as $key => $field) {
                    $object = new \Magento\Framework\DataObject;
                    $object->addData($field);
                    $fields[$key] = $object;
                }
            }
            $this->_fields = $fields;
        }
        return $this->_fields;
    }

    /**
     * @return mixed
     */
    public function getFormKey()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $formKey = $objectManager->get(\Magento\Framework\Data\Form\FormKey::class);
        return $formKey->getFormKey();
    }
}
