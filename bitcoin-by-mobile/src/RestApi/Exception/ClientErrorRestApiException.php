<?php

namespace RestApi\Exception;

use RestApi\Exception\RestApiException;

class ClientErrorRestApiException extends RestApiException {

    protected $httpStatusCode = 400;

}
