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
 * Interface ContactInterface
 * @package Ecomteck\AdvancedContact\Api\Data
 */
interface ContactInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const NAME                = 'name';
    const EMAIL               = 'email';
    const TELEPHONE           = 'telephone';
    const COMMENT             = 'comment';
    /**#@-*/

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Get telephone
     *
     * @return string|null
     */
    public function getTelephone();

    /**
     * Get comment
     *
     * @return string|null
     */
    public function getComment();

    /**
     * Set name
     *
     * @param string $name
     * @return \Ecomteck\AdvancedContact\Api\Data\ContactInterface
     */
    public function setName($name);

    /**
     * Set email
     *
     * @param string $email
     * @return \Ecomteck\AdvancedContact\Api\Data\ContactInterface
     */
    public function setEmail($email);

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return \Ecomteck\AdvancedContact\Api\Data\ContactInterface
     */
    public function setTelephone($telephone);

    /**
     * Set comment
     *
     * @param string $comment
     * @return \Ecomteck\AdvancedContact\Api\Data\ContactInterface
     */
    public function setComment($comment);
}
