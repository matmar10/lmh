<?php

namespace Msisdn\Service;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Yaml\Parser;
use Msisdn\Service\MsisdnFormatConfigurationService;

class MsisdnValidator extends ConstraintValidator {

    public static $configurationService;

    public function __construct(MsisdnFormatConfigurationService $configurationService)
    {
        self::$configurationService = $configurationService;
    }

    public function isValid($msisdn, Constraint $constraint)
    {
        $msisdnFormat = $msisdn->getMsisdnFormat();

        $country = $msisdnFormat->getCountry();

        $msisdnValue = $msisdn->getMsisdn();

        $countryRegexPossibilities = $msisdnFormat->getFormats();

        foreach($countryRegexPossibilities as $regex) {
            if(false != preg_match($regex, $msisdnValue)) {
                return true;
            }
        }

        $this->setMessage($constraint->message, array(
            '%msisdn%' => $msisdnValue,
            '%country%' => $country,
        ));

        return false;
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
