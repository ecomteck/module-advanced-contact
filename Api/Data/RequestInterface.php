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
 * Interface RequestInterface
 * @package Ecomteck\AdvancedContact\Api\Data
 */
interface RequestInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const CONTACT_ID          = 'contact_id';
    const INFO                = 'info';
    const CLOSED              = 'closed';
    const CREATED             = 'created';
    const UPDATED             = 'updated';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get info
     *
     * @return \Ecomteck\AdvancedContact\Api\Data\InfoInterface[]
     */
    public function getInfo();

    /**
     * Get closed
     *
     * @return int|null
     */
    public function getClosed();

    /**
     * Get created
     *
     * @return string
     */
    public function getCreated();

    /**
     * Get updated
     *
     * @return string
     */
    public function getUpdated();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface
     */
    public function setId($id);

    /**
     * Set info
     *
     * @param \Ecomteck\AdvancedContact\Api\Data\InfoInterface[] $info
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface
     */
    public function setInfo($info);

    /**
     * Set closed
     *
     * @param int $closed
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface
     */
    public function setClosed($closed);

    /**
     * Set created
     *
     * @param string $created
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface
     */
    public function setCreated($created);

    /**
     * Set updated
     *
     * @param int $updated
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface
     */
    public function setUpdated($updated);
}