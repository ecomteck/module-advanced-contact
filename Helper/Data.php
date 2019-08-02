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

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 * @package Ecomteck\AdvancedContact\Helper
 */
class Data extends AbstractHelper
{
    /**
     * getConfig function
     *
     * @param $field
     * @param int $storeId
     * @return mixed
     */
    public function getConfig($field, $storeId = 0)
    {
        return $this->scopeConfig->getValue(
            'contact/'.$field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
