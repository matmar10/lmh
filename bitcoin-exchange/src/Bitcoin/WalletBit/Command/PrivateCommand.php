<?php

namespace Bitcoin\WalletBit\Command;

use BitcoinExchangeRestApi\Command\DynamicCommand;

class PrivateCommand extends DynamicCommand
{
    private static $fieldSigningOrder = array(
        'send' => array(
            'merchant',
            'customer_email',
            'amount',
        ),
        'send_to' => array(
            'merchant',
            'to',
            'from',
        ),
        'get_new_address' => array(
            'merchant',
            'label',
        ),
        'lookup_deposit_address' => array(
            'merchant',
            'address',
        ),
    );

    /**
     * @see https://walletbit.com/docs/api
     */
    protected function build()
    {
        parent::build();

        // sign the request
        // see https://walletbit.com/docs/api/sendto
        $merchant = $this->client->getMerchant();
        $apiKey = $this->client->getApiKey();

        $this->request->addPostFields(array(
            'merchant' => $merchant,
        ));

        $postData = $this->request->getPostFields();
        $commandName = $this->getName();
        $fieldSigningOrder = self::$fieldSigningOrder[$commandName];
        $postFieldString = '';
        foreach($fieldSigningOrder as $fieldName) {
            $postFieldString .= $postData[$fieldName] . ':';
        }
        $postFieldString .= $apiKey;
        $encrypted = strtoupper(hash('sha256', $postFieldString));
        $this->request->addPostFields(array(
            'encrypted' => $encrypted,
        ));
    }
}
