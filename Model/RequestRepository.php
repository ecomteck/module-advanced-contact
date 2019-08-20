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

use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Class RequestRepository
 * @package Ecomteck\AdvancedContact\Model
 */
class RequestRepository implements \Ecomteck\AdvancedContact\Api\RequestRepositoryInterface
{
    /**
     * @var \Ecomteck\AdvancedContact\Helper\Data
     */
    protected $helperData;

    /**
     * @var \Ecomteck\AdvancedContact\Helper\Email
     */
    protected $email;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $json;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Ecomteck\AdvancedContact\Model\RequestFactory
     */
    protected $requestFactory;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * RequestRepository constructor.
     * @param \Ecomteck\AdvancedContact\Helper\Data $helperData
     * @param \Ecomteck\AdvancedContact\Helper\Email $email
     * @param \Magento\Framework\Serialize\Serializer\Json $json
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param RequestFactory $requestFactory
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(
        \Ecomteck\AdvancedContact\Helper\Data $helperData,
        \Ecomteck\AdvancedContact\Helper\Email $email,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Ecomteck\AdvancedContact\Model\RequestFactory $requestFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->helperData = $helperData;
        $this->email = $email;
        $this->json = $json;
        $this->storeManager = $storeManager;
        $this->requestFactory = $requestFactory;
        $this->messageManager = $messageManager;
    }

    /**
     * Send contact.
     *
     * @param \Ecomteck\AdvancedContact\Api\Data\RequestInterface $request
     * @return \Ecomteck\AdvancedContact\Api\Data\RequestInterface|void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Ecomteck\AdvancedContact\Api\Data\RequestInterface $request)
    {
        $items = $request->getInfo();
        $data = [];
        foreach ($items as $item) {
            $data[$item->getKey()] = $item->getValue();
        }
        $storeId = $this->storeManager->getStore()->getId();
        $fields = $this->helperData->getConfig('advanced_contact/fields', $storeId);
        $fields = $this->json->unserialize($fields);
        $info = [];
        if (count($fields)>0) {
            foreach ($fields as $field) {
                try {
                    if ($data[$field['key']]) {
                        $info[] = [
                            'key'   => $field['key'],
                            'label' => $field['label'],
                            'type'  => $field['field_type'],
                            'value' => $data[$field['key']]
                        ];
                    }
                } catch (\Exception $e) {
                    throw new CouldNotSaveException(
                        __('Could not get any fields form: %1', $e->getMessage()),
                        $e
                    );
                }
            }
        }

        if (count($info)>0) {
            $requestModel = $this->requestFactory->create();
            $requestModel->setData('info', $this->json->serialize($info));
            try {
                $requestModel->save();
                if ($requestModel->getId()) {
                    $this->email->receive($requestModel, $storeId);
                    $this->messageManager->addSuccess(__('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.'));
                }
            } catch (\Exception $exception) {
                throw new CouldNotSaveException(
                    __('Could not save and sent contact: %1', $exception->getMessage()),
                    $exception
                );
            }
        }
    }

    /**
     * get list fields
     *
     * @return array|void
     * @throws CouldNotSaveException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getListFields()
    {
        $storeId = $this->storeManager->getStore()->getId();
        $fields = $this->helperData->getConfig('advanced_contact/fields', $storeId);
        $fields = $this->json->unserialize($fields);

        $info = [];
        if (count($fields)>0) {
            foreach ($fields as $field) {
                try {
                        $info[] = [
                            'key'  => $field['key'],
                            'label' => $field['label'],
                            'class'  => $field['field_class'],
                            'field_type'  => $field['field_type']
                        ];
                } catch (\Exception $e) {
                    throw new CouldNotSaveException(
                        __('Could not get any fields form: %1', $e->getMessage()),
                        $e
                    );
                }
            }
        }

        return $info;
    }
}
