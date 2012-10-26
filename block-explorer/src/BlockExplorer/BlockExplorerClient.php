<?php

namespace BlockExplorer;

use Guzzle\Service\Client;
use Guzzle\Service\Inspector;
use Guzzle\Service\Description\ServiceDescription;

class BlockExplorerClient extends Client
{

    public static function factory($config = array())
    {
        $default = array(
            'base_url' => '{scheme}://blockexplorer.com/q/',
            'scheme' => 'http',
        );
        
        $required = array();

        $config = Inspector::prepareConfig($config, $default, $required);

        $client = new self($config->get('base_url'));
        $client->setConfig($config);

        // Uncomment the following two lines to use an XML service description
        $client->setDescription(ServiceDescription::factory(__DIR__ . '/' . 'client.xml'));

        return $client;
    }

    /**
     * Client constructor
     *
     * @param string $baseUrl  Base URL of the web service
     */
    public function __construct($baseUrl)
    {
        parent::__construct($baseUrl);
        $userAgent = 'Mozilla/4.0 (compatible; MtGox PHP client; '.php_uname('s').'; PHP/'.phpversion().')';
        $this->setUserAgent($userAgent);
    }
    
}
