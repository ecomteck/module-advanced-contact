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

namespace Ecomteck\AdvancedContact\Model;

use Ecomteck\AdvancedContact\Api\Data\ContactInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Contact
 * @package Ecomteck\AdvancedContact\Model
 */
class Contact extends AbstractModel implements ContactInterface
{

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get telephone
     *
     * @return string|null
     */
    public function getTelephone()
    {
        return $this->getData(self::TELEPHONE);
    }

    /**
     * Get comment
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return \Ecomteck\AdvancedContact\Api\Data\ContactInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set email
     *
     * @param string $email
     * @return \Ecomteck\AdvancedContact\Api\Data\ContactInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return \Ecomteck\AdvancedContact\Api\Data\ContactInterface
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return \Ecomteck\AdvancedContact\Api\Data\ContactInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }
}
