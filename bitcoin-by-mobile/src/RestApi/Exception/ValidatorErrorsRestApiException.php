<?php

namespace RestApi\Exception;

use RestApi\Exception\ClientErrorRestApiException;
use Symfony\Component\Validator\ConstraintViolationList;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\ReadOnly;
use JMS\SerializerBundle\Annotation\SerializedName;

/**
 * @ExclusionPolicy("none")
 */
class ValidatorErrorsRestApiException extends ClientErrorRestApiException  implements SerializableExceptionInterface {

    protected $validatorErrors;

    public function __construct(ConstraintViolationList $validatorErrors, $message = 'The entity was determined to be invalid by the entity validator.')
    {
        $this->validatorErrors = $validatorErrors;
        parent::__construct($message);
    }

    public function setValidatorErrors(ConstraintViolationList $validatorErrors)
    {
        $this->validatorErrors = $validatorErrors;
    }

    public function getValidatorErrors()
    {
        return $this->validatorErrors;
    }

    public function getSerializationEntityClassName()
    {
        return '\RestApi\Entity\ValidatorErrorsRestApiExceptionEntity';
    }
}
