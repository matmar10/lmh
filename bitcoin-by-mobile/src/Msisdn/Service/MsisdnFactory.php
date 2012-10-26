<?php

namespace Msisdn\Service;

use Msisdn\Entity\Msisdn;
use Msisdn\Validator\Constraints\Msisdn as MsisdnConstraint;
use Msisdn\Service\MsisdnFormatConfigurationService;
use Symfony\Component\Validator\Validator;
use Msisdn\Exception\InvalidFormatException;

class MsisdnFactory {

    public static $configurationService;

    public static $validator;

    public function __construct(MsisdnFormatConfigurationService $configurationService, Validator $validator)
    {
        self::$configurationService = $configurationService;
        self::$validator = $validator;
    }

    public function get($country, $mobileNumber)
    {
        $prefix = self::$configurationService->getCountryPrefix($country);
        $mobileNumberWithPrefix = (false === strpos($mobileNumber, $prefix)) ? $prefix . $mobileNumber : $mobileNumber;

        $msisdn = new Msisdn();
        $msisdn->setCountry($country);
        $msisdn->setCountryPrefix($prefix);

        $msisdn->setMsisdn($mobileNumberWithPrefix);
        
        $msisdnConstraint = new MsisdnConstraint();
        $errors = self::$validator->validateValue($msisdn, $msisdnConstraint);
        if(count($errors)) {
            throw new InvalidFormatException("Cannot build a '$country' msisdn from mobile number '$mobileNumber': the format is invalid.");
        }

        return $msisdn;
    }

}
