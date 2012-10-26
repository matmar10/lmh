<?php

namespace Bitstamp;

use Guzzle\Service\Client;
use Guzzle\Service\Inspector;
use Guzzle\Service\Description\ServiceDescription;

class BitstampClient extends Client
{

    protected $user;

    protected $password;

    public static function factory($config = array())
    {
        $default = array(
            'base_url' => '{scheme}://bitstamp.net/',
            'scheme' => 'https',
        );
        $required = array(
            'base_url',
            'user',
            'password',
        );
        $config = Inspector::prepareConfig($config, $default, $required);

        $client = new self(
            $config->get('base_url'),
            $config->get('user'),
            $config->get('password')
        );
        $client->setConfig($config);
        $client->setDescription(ServiceDescription::factory(__DIR__ . '/' . 'client.xml'));

        return $client;
    }

    /**
     * Client constructor
     *
     * @param string $baseUrl  Base URL of the web service
     * @param string $user Your Bitstamp username
     * @param string $password Your Bistamp password
     */
    public function __construct($baseUrl, $user, $password)
    {
        parent::__construct($baseUrl, array(
            'curl.CURLOPT_SSL_VERIFYPEER' => false,
            //'curl.CURLOPT_FOLLOWLOCATION' => true,
            'curl.BODY_AS_STRING' => true,
            // 'curl.BODY_AS_STRING' => true,
        ));
        $this->user = $user;
        $this->password = $password;

        $userAgent = 'Mozilla/4.0 (compatible; MtGox PHP client; '.php_uname('s').'; PHP/'.phpversion().')';
        $this->setUserAgent($userAgent);
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}
