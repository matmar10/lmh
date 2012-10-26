<?php

namespace RestApi\Exception;

use RestApi\Exception\ClientErrorRestApiException;

class UnsupportedCountryRestApiException extends ClientErrorRestApiException
{
    protected $httpStatusCode = 400;

    public function __construct($country, $message = 'The country "%s"  is not supported.')
    {
        parent::__construct(sprintf($message, $country));
    }

    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }
}