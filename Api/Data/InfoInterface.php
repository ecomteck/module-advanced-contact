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

namespace Ecomteck\AdvancedContact\Api\Data;

/**
 * Interface InfoInterface
 * @package Ecomteck\AdvancedContact\Api\Data
 */
interface InfoInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const KEY                = 'key';
    const VALUE              = 'value';
    /**#@-*/

    /**
     * Get key
     *
     * @return string|null
     */
    public function getKey();

    /**
     * Get value
     *
     * @return string|null
     */
    public function getValue();

    /**
     * Set key
     *
     * @param string $key
     * @return \Ecomteck\AdvancedContact\Api\Data\InfoInterface
     */
    public function setKey($key);

    /**
     * Set value
     *
     * @param string $value
     * @return \Ecomteck\AdvancedContact\Api\Data\InfoInterface
     */
    public function setValue($value);
}