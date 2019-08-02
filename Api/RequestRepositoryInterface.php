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

namespace Ecomteck\AdvancedContact\Api;

/**
 * Interface RequestRepositoryInterface
 * @package Ecomteck\AdvancedContact\Api
 */
interface RequestRepositoryInterface
{
    /**
     * Send And Save request.
     *
     * @param \Ecomteck\AdvancedContact\Api\Data\RequestInterface $request
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Ecomteck\AdvancedContact\Api\Data\RequestInterface $request);

    /**
     * get list fields for contact form
     *
     * @return string
     */
    public function getListFields();
}
