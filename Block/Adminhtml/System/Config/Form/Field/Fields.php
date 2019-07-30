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
namespace Ecomteck\AdvancedContact\Block\Adminhtml\System\Config\Form\Field;

/**
 * Class Fields
 * @package Ecomteck\AdvancedContact\Block\Adminhtml\System\Config\Form\Field
 */
class Fields extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{
    /**
     * type render
     */
    private $_typeRenderer;

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function getTypeRenderer()
    {
        if (!$this->_typeRenderer) {
            $this->_typeRenderer = $this->getLayout()->createBlock(
                \Ecomteck\AdvancedContact\Block\Adminhtml\System\Config\Form\Field\Fields\Type::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->_typeRenderer
            ->addOption('text', 'text')
            ->addOption('textarea', 'textarea')
            ->addOption('email', 'email');
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareToRender()
    {
        $this->addColumn('key', [
                'label' => __('Key'),
                'style'=>'min-width:100px',
                'class' => 'input-text required'
            ]);
        $this->addColumn('label', [
                'label' => __('Label'),
                'style'=>'min-width:100px',
                'class' => 'input-text required'
            ]);
        $this->addColumn('field_class', [
                'label' => __('Field Class'),
                'style'=>'min-width:100px'
            ]);
        $this->addColumn('field_type', [
                'label' => __('Type'),
                'style'=>'min-width:100px',
                'renderer' => $this->getTypeRenderer()
            ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * @param \Magento\Framework\DataObject $row
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareArrayRow(\Magento\Framework\DataObject $row)
    {
        $options = [];

        $type = $row->getData('field_type');
        $key = 'option_' . $this->getTypeRenderer()->calcOptionHash($type);
        $options[$key] = 'selected="selected"';
        
        $row->setData('option_extra_attrs', $options);
    }
}
