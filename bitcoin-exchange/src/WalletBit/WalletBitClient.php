<?php

namespace WalletBit;

use Guzzle\Service\Client;
use Guzzle\Service\Inspector;
use Guzzle\Service\Description\ServiceDescription;

class WalletBitClient extends Client
{
    protected $merchant;
    protected $apiKey;

    public static function factory($config = array())
    {
        $default = array(
            'base_url' => '{scheme}://walletbit.com',
            'scheme' => 'https',
        );
        $required = array(
            'merchant',
            'api_key',
        );
        $config = Inspector::prepareConfig($config, $default, $required);

        $client = new self(
            $config->get('base_url'),
            $config->get('merchant'),
            $config->get('api_key')
        );
        $client->setConfig($config);

        // Uncomment the following two lines to use an XML service description
        $client->setDescription(ServiceDescription::factory(__DIR__ . '/' . 'client.xml'));

        return $client;
    }

    /**
     * Client constructor
     *
     * @param string $baseUrl  Base URL of the web service
     * @param string $apiKey API access key
     * @param string $apiSecret API secret to sign the request
     */
    public function __construct($baseUrl, $merchant, $apiKey)
    {
        parent::__construct($baseUrl, array(
            'curl.CURLOPT_SSL_VERIFYPEER' => true,
            'curl.CURLOPT_SSL_VERIFYHOST' => true,
            'curl.CURLOPT_RETURNTRANSFER' => 1,
        ));

        $this->merchant = $merchant;
        $this->apiKey = $apiKey;
    }

    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
    }

    public function getMerchant()
    {
        return $this->merchant;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }
}
