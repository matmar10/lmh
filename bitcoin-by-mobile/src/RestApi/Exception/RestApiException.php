<?php

namespace RestApi\Exception;

use JMS\SerializerBundle\Annotation\AccessType;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\ReadOnly;
use JMS\SerializerBundle\Annotation\Exclude;
use Lmh\UtilBundle\Uuid;


class RestApiException extends \Exception implements StatusCodeInterface, SerializableExceptionInterface {

    const HTTP_STATUS_CODE_DEFAULT = 500;

    protected $httpStatusCode = 500;

    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    public function getSerializationEntityClassName()
    {
        return 'RestApi\Entity\RestApiExceptionEntity';
    }
}
