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
namespace Ecomteck\AdvancedContact\Model\ResourceModel\Request;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Ecomteck\AdvancedContact\Model\ResourceModel\Request
 */
class Collection extends AbstractCollection
{
    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'ecomteck_advanced_contact_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'advanced_contact_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Ecomteck\AdvancedContact\Model\Request::class,
            \Ecomteck\AdvancedContact\Model\ResourceModel\Request::class
        );
    }
}
