<?php
/**
 * Ecomteck
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the ecomteck.com license that is
 * available through the world-wide-web at this URL:
 * https://ecomteck.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Ecomteck
 * @package     Ecomteck_AdvancedContact
 * @copyright   Copyright (c) 2019 Ecomteck (https://ecomteck.com/)
 * @license     https://ecomteck.com/LICENSE.txt
 */
namespace Ecomteck\AdvancedContact\Plugin;

/**
 * Class ContactForm
 * @package Ecomteck\AdvancedContact\Plugin
 */
class ContactForm
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManagerInterface;

    /**
     * @var \Ecomteck\AdvancedContact\Helper\Data
     */
    protected $_helper;

    /**
     * ContactForm constructor.
     *
     * @param \Magento\Store\Model\StoreManagerInterface $storeManagerInterface
     * @param \Ecomteck\AdvancedContact\Helper\Data $helper
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Ecomteck\AdvancedContact\Helper\Data $helper
    ) {
        $this->_storeManagerInterface = $storeManagerInterface;
        $this->_helper = $helper;
    }

    /**
     * @param $subject
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeToHtml($subject)
    {
        if ($this->_helper->getConfig(
            'advanced_contact/advanced_contact_active',
            $this->_storeManagerInterface->getStore()->getId()
        ) == "1") {
            $subject->setTemplate('Ecomteck_AdvancedContact::form.phtml');
        }
    }
}
