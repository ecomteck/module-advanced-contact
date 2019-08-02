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
namespace Ecomteck\AdvancedContact\Model;

use Magento\Framework\Model\AbstractModel;
use Ecomteck\AdvancedContact\Api\Data\RequestInterface;

/**
 * Class Request
 * @package Ecomteck\AdvancedContact\Model
 */
class Request extends AbstractModel implements RequestInterface
{
    protected function _construct()
    {
        $this->_init(\Ecomteck\AdvancedContact\Model\ResourceModel\Request::class);
    }

    /**
     * Get info
     *
     * @return \Ecomteck\AdvancedContact\Api\Data\InfoInterface[]
     */
    public function getInfo()
    {
        return $this->getData(self::INFO);
    }

    /**
     * Get closed
     *
     * @return int|null
     */
    public function getClosed()
    {
        return $this->getData(self::CLOSED);
    }

    /**
     * Get created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->getData(self::CREATED);
    }

    /**
     * Get updated
     *
     * @return string
     */
    public function getUpdated()
    {
        return $this->getData(self::UPDATED);
    }

    /**
     * Set info
     *
     * @param string $info
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface
     */
    public function setInfo($info)
    {
        return $this->setData(self::INFO, $info);
    }

    /**
     * Set closed
     *
     * @param int $closed
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface
     */
    public function setClosed($closed)
    {
        return $this->setData(self::CLOSED, $closed);
    }

    /**
     * Set created
     *
     * @param string $created
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface
     */
    public function setCreated($created)
    {
        return $this->setData(self::CREATED, $created);
    }

    /**
     * Set updated
     *
     * @param int $updated
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface
     */
    public function setUpdated($updated)
    {
        return $this->setData(self::UPDATED, $updated);
    }
}
