<?php

namespace RestApi\Entity;

use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\ReadOnly;
use RestApi\Entity\RestApiExceptionEntity;
use RestApi\Exception\ValidatorErrorsRestApiException;

/**
 * @ExclusionPolicy("none")
 */
class ValidatorErrorsRestApiExceptionEntity extends RestApiExceptionEntity {

    /**
     * @Type("Array")
     * @ReadOnly
     */
    protected $validatorErrors;

    public function __construct(ValidatorErrorsRestApiException $exception)
    {
        parent::__construct($exception);
        $this->validatorErrors = $exception->getValidatorErrors();
    }

}
