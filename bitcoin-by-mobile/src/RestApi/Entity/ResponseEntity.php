<?php

namespace RestApi\Entity;

use JMS\SerializerBundle\Annotation\AccessType;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\ReadOnly;

/**
 * @AccessType("public_method")
 * @ExclusionPolicy("none")
 */
class ResponseEntity {

    /**
     * @Type("boolean")
     * @ReadOnly
     */
    protected $success = true;

    /**
     * @Type("object")
     * @ReadOnly
     */
    protected $return = null;

    /**
     * @Type("\RestApi\Entity\RestApiExceptionEntity")
     * @ReadOnly
     */
    protected $exception = null;

    public function setException(\Exception $exception)
    {
        $this->exception = $exception;
    }

    public function getException()
    {
        return $this->exception;
    }

    public function setReturn($return)
    {
        $this->return = $return;
    }

    public function getReturn()
    {
        return $this->return;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function getSuccess()
    {
        return $this->success;
    }
}
