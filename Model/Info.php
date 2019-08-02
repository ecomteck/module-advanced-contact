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
 * @package     Ecomteck_
 * @copyright   Copyright (c) 2019 Ecomteck (https://ecomteck.com/)
 * @license     https://ecomteck.com/LICENSE.txt
 */

namespace Ecomteck\AdvancedContact\Model;

use Magento\Framework\Model\AbstractModel;
use Ecomteck\AdvancedContact\Api\Data\InfoInterface;

class Info extends AbstractModel implements InfoInterface
{

    /**
     * Get key
     *
     * @return string|null
     */
    public function getKey()
    {
        return $this->getData(self::KEY);
    }

    /**
     * Get value
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->getData(self::VALUE);
    }

    /**
     * Set key
     *
     * @param string $key
     * @return \Ecomteck\AdvancedContact\Api\Data\InfoInterface
     */
    public function setKey($key)
    {
        return $this->setData(self::KEY, $key);
    }

    /**
     * Set value
     *
     * @param string $value
     * @return \Ecomteck\AdvancedContact\Api\Data\InfoInterface
     */
    public function setValue($value)
    {
        return $this->setData(self::VALUE, $value);
    }
}
