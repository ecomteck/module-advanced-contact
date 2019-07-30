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

use Magento\Contact\Model\MailInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class ContactRepository
 * @package Ecomteck\AdvancedContact\Model
 */
class ContactRepository implements \Ecomteck\AdvancedContact\Api\ContactRepositoryInterface
{
    /**
     * @var MailInterface
     */
    private $mail;

    /**
     * ContactRepository constructor.
     * @param MailInterface $mail
     */
    public function __construct(MailInterface $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Send contact.
     *
     * @param \Ecomteck\AdvancedContact\Api\Data\ContactInterface $contact
     * @return \Ecomteck\AdvancedContact\Api\Data\ContactInterface|void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function sendContact(\Ecomteck\AdvancedContact\Api\Data\ContactInterface $contact)
    {
        if (trim($contact->getName()) === '') {
            throw new LocalizedException(__('Enter the Name and try again.'));
        }
        if (false === \strpos($contact->getEmail(), '@')) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }
        if (trim($contact->getComment()) === '') {
            throw new LocalizedException(__('Enter the comment and try again.'));
        }

        $data = $contact->getData();
        try {
            $this->sendEmail($data);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not sent contact: %1', $exception->getMessage()),
                $exception
            );
        }
    }

    /**
     * Send an email to administrator
     *
     * @param array $data
     * @return void
     */
    private function sendEmail($data)
    {
        $this->mail->send(
            $data['email'],
            ['data' => new DataObject($data)]
        );
    }
}
