<?php

namespace Msisdn\Exception;

use RestApi\Exception\StatusCodeInterface;

class InvalidFormatException extends \Exception implements StatusCodeInterface {

    public function getHttpStatusCode()
    {
        return 400;
    }

}
