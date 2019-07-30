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
namespace Ecomteck\AdvancedContact\Helper;

use \Magento\Framework\App\ObjectManager;

/**
 * Class Email
 * @package Ecomteck\AdvancedContact\Helper
 */
class Email extends \Ecomteck\AdvancedContact\Helper\Data
{
    const EMAIL_TYPE = 'email';

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $_json;

    /**
     * Email constructor.
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Serialize\Serializer\Json $json
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Serialize\Serializer\Json $json
    ) {
        $this->_json = $json;
        parent::__construct($context);
    }

    /**
     * @param \Ecomteck\AdvancedContact\Model\Request $request
     * @param int $storeId
     */
    public function recive(\Ecomteck\AdvancedContact\Model\Request $request, $storeId = 0)
    {
        $to = $this->getConfig('advanced_contact/send_to');
        if ((bool)$to !== false) {
            $info = $request->getData('info');
            $info = $this->_json->unserialize($info);
            if (is_array($info) && count($info)>0) {
                foreach ($info as $field) {
                    if (@$field['type'] == self::EMAIL_TYPE) {
                        $this->send($field['value'], $to, $this->toVars($info), $storeId);
                    }
                }
            }
        }
    }

    /**
     * toVars function
     *
     * @param $array
     * @return array
     */
    public function toVars($array)
    {
        $vars = [];
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $field) {
                $vars[$field['key']] = $field['value'];
            }
        }
        return $vars;
    }

    /**
     * send function
     *
     * @param $from
     * @param $to
     * @param $vars
     * @param int $storeId
     */
    public function send($from, $to, $vars, $storeId = 0)
    {
        $translator = ObjectManager::getInstance()->get(\Magento\Framework\Translate\Inline\StateInterface::class);
        $transport = ObjectManager::getInstance()->get(\Magento\Framework\Mail\Template\TransportBuilder::class);
        try {
            $translator->suspend();
            $transport->setTemplateIdentifier(
                $this->getConfig('advanced_contact/email_template', $storeId)
            );
            $transport->setTemplateOptions([
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => $storeId
                ]);
            $transport->addTo([$to]);
            $transport->setFrom(['name'=>__('Customer'), 'email' => $from]);
            $transport->setTemplateVars($vars);
            $transport->getTransport()->sendMessage();
            $translator->resume();
        } catch (\Exception $e) {

        }
    }
}
