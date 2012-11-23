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

    public function get($country, $mobileNumber, $isMsisdn = false)
    {
        $msisdnFormat = self::$configurationService->get($country);
        $msisdn = new Msisdn();
        $msisdn->setMsisdnFormat($msisdnFormat);

        if($isMsisdn || $mobileNumber instanceof Msisdn) {
            $msisdn->setMsisdn($mobileNumber);
        } else {
            // strip the national dialing prefix, if it exists (since it's not part of a msisdn)
            $nationalDialingPrefix = $msisdnFormat->getNationalDialingPrefix();
            $stripped = $mobileNumber;
            if(strlen($nationalDialingPrefix)) {
                if(0 === strpos($mobileNumber, $nationalDialingPrefix)) {
                    $stripped = substr($mobileNumber, strlen($nationalDialingPrefix));
                }
            }
            $msisdnValue = $msisdnFormat->getInternationalPrefix() . $stripped;
            $msisdn->setMsisdn($msisdnValue);
        }

        $msisdnConstraint = new MsisdnConstraint();
        $constraintViolationList = self::$validator->validateValue($msisdn, $msisdnConstraint);
        if(count($constraintViolationList)) {


            echo "MOBILE: ";
            print_r($mobileNumber);
            echo "\n";
            echo "MSISDN: ";
            print_r($msisdnValue);
            echo "\n";
            die();


            $messageFormat = "Cannot build a '%s' msisdn from mobile number '%s': the format is invalid (example mobile format: '%s').";
            $message = sprintf($messageFormat, $country, $mobileNumber, $msisdnFormat->getExampleMobile());
            throw new InvalidFormatException($constraintViolationList, $message);
        }


        return $msisdn;
    }

}
