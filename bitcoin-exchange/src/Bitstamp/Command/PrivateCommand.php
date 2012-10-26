<?php

namespace Bitstamp\Command;

use BitcoinExchangeRestApi\Command\DynamicCommand as DynamicCommand;

class PrivateCommand extends DynamicCommand
{

    protected function build()
    {

        parent::build();

        $postFields = $this->request->getPostFields()->getAll();

        print_r($postFields);

        $params = array_merge($postFields, array(), array(
            'user' => $this->client->getUser(),
            'password' => $this->client->getPassword(),
        ));
/*
        $this->request->addPostFields(array(
            'user' => $this->client->getUser(),
            'password' => $this->client->getPassword(),
        ));
*/
        $this->request->setBody(http_build_query($params));


    }
}
