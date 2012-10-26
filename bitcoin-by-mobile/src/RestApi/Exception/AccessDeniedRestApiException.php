<?php

namespace RestApi\Exception;

use RestApi\Exception\RestApiException;

class AccessDeniedRestApiException extends RestApiException {

    protected $httpStatusCode = 401;
    
}
