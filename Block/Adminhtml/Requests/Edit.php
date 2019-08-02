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
namespace Ecomteck\AdvancedContact\Block\Adminhtml\Requests;

/**
 * Class Edit
 * @package Ecomteck\AdvancedContact\Block\Adminhtml\Requests
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * @var \Magento\Framework\Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * Edit constructor.
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * _construct
     */
    protected function _construct()
    {
        $this->_objectId = 'request_id';
        $this->_blockGroup = 'Ecomteck_AdvancedContact';
        $this->_controller = 'adminhtml_requests';
        parent::_construct();
        if ($this->_isAllowedAction('Ecomteck_AdvancedContact::requests')) {
            $this->buttonList->remove('reset');
            $this->buttonList->update('save', 'label', __('Update Request'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Update and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('delete');
    }

    /**
     * get Header Text
     *
     * @return \Magento\Framework\Phrase|string
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('request')->getId()) {
            return __("Edit Request '%1'", $this->escapeHtml($this->_coreRegistry->registry('request')->getId()));
        } else {
            return __('New Request');
        }
    }

    /**
     * @param $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }

    /**
     * prepare Layout
     *
     * @return \Magento\Backend\Block\Widget\Form\Container
     */
    protected function _prepareLayout()
    {
        $this->_formScripts[] = "
			function toggleEditor() {
				if (tinyMCE.getInstanceById('general_content') == null) {
					tinyMCE.execCommand('mceAddControl', false, 'general_content');
				} else {
					tinyMCE.execCommand('mceRemoveControl', false, 'general_content');
				}
			};
		";
        return parent::_prepareLayout();
    }
}
