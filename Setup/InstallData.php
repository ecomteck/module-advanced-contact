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
namespace Ecomteck\AdvancedContact\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

/**
 * Class InstallData
 * @package Ecomteck\AdvancedContact\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var \Magento\Config\Model\ResourceModel\Config
     */
    protected $_resourceConfig;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $_json;

    /**
     * InstallData constructor.
     * @param \Magento\Config\Model\ResourceModel\Config $resourceConfig
     * @param \Magento\Framework\Serialize\Serializer\Json $json
     */
    public function __construct(
        \Magento\Config\Model\ResourceModel\Config $resourceConfig,
        \Magento\Framework\Serialize\Serializer\Json $json
    ) {
        $this->_json = $json;
        $this->_resourceConfig = $resourceConfig;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $default = [
            'fields' => [
                [
                    'key' => 'email',
                    'label' => 'E-Mail',
                    'field_class' => 'required validate-email',
                    'field_type' => 'email'
                ],
                [
                    'key' => 'message',
                    'label' => 'Message',
                    'field_class' => 'required',
                    'field_type' => 'textarea'
                ]
            ]
        ];
        $this->_resourceConfig->saveConfig(
            'ecomteck_contact/general/fields',
            $this->_json->serialize($default['fields']),
            'default',
            0
        );
    }
}
