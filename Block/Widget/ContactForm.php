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
namespace Ecomteck\AdvancedContact\Block\Widget;

class ContactForm extends \Ecomteck\AdvancedContact\Block\ContactForm implements \Magento\Widget\Block\BlockInterface{

    public function _toHtml(){
        $title = $this->getData("title");
        $this->assign("widget_heading", $title);
        if ($this->hasData("custom_template") && $this->getData("custom_template")) {
            $my_template = $this->getData("custom_template");
            $this->setTemplate($my_template);
        }else {
            $this->setTemplate("Ecomteck_AdvancedContact::widget/form.phtml");
        }
        return parent::_toHtml();
    }
}