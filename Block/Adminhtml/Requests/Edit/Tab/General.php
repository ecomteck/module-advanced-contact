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
namespace Ecomteck\AdvancedContact\Block\Adminhtml\Requests\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Class General
 * @package Ecomteck\AdvancedContact\Block\Adminhtml\Requests\Edit\Tab
 */
class General extends Generic implements TabInterface
{
    /**
     * @var Config
     */
    protected $_wysiwygConfig;

    /**
     * @var Json
     */
    protected $_json;

    /**
     * General constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Json $json
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Json $json,
        array $data = []
    ) {
        $this->_json = $json;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('request');
        $form = $this->_formFactory->create();
 
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Info')]
        );
 
        if ($model->getId()) {
            $fieldset->addField(
                'contact_id',
                'hidden',
                ['name' => 'contact_id']
            );
        }
        $info = $model->getData('info');
        $info = $this->_json->unserialize($info);
        if (count($info)>0) {
            foreach ($info as $field) {
                try {
                    $model->setData('info_'.$field['key'], $field['value']);
                    $fieldset->addField(
                        'info_'.$field['key'],
                        'label',
                        [
                            'name' => 'html',
                            'label'    => $field['label'],
                            'required' => false,
                            'disabled' => true
                        ]
                    );
                } catch (\Exception $e) {

                }
            }
        }
        
        $fieldset->addField(
            'closed',
            'select',
            [
                'name' => 'closed',
                'label'    => __('Closed'),
                'required' => true,
                'values' => [
                    ['value'=>"1",'label'=>__('Yes')],
                    ['value'=>"0",'label'=>__('No')]
                ]
            ]
        );
        $fieldset->addField(
            'created',
            'date',
            [
                'name' => 'created',
                'label'    => __('Created'),
                'required' => false,
                'disabled' => true,
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss'
            ]
        );
        $fieldset->addField(
            'updated',
            'date',
            [
                'name' => 'updated',
                'label'    => __('Updated'),
                'required' => false,
                'disabled' => true,
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss'
            ]
        );
        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);
 
        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('Info');
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('Info');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}
