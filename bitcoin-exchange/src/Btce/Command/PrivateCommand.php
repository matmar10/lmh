<?php

namespace Btce\Command;

use BitcoinExchangeRestApi\Command\DynamicCommand;

class PrivateCommand extends DynamicCommand
{

    protected $nonce;

    /**
     * @see http://pastebin.com/QyjS3U9M
     */
    protected function build()
    {
        parent::build();

        $apiKey = $this->client->getApiKey();
        $apiSecret = $this->client->getApiSecret();

        $this->request->addPostFields(array(
            'method' => $this->getName(),
            'nonce' => $this->getNonce(),
        ));

        $postData = $this->request->getPostFields();
        $signature = hash_hmac('sha512', $postData, $apiSecret);

        $this->request->addHeader('Sign', $signature);
        $this->request->addHeader('Key', $apiKey);
    }

    public function setNonce($nonce)
    {
        $this->nonce = $nonce;
    }

    public function getNonce()
    {
        if(is_null($this->nonce)) {
            $this->setNonce(self::generateNonce());
        }
        return $this->nonce;
    }

    public static function generateNonce() {
        $mt = explode(' ', microtime());
        return $mt[1];
    }
}
