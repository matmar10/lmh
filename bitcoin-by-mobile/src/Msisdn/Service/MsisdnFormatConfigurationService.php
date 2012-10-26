<?php

namespace Msisdn\Service;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Yaml\Parser;

class MsisdnFormatConfigurationService {

    public static $msisdnFormatConfigFilename;

    public static $msisdnFormatData;

    public function __construct($msisdnFormatConfigFilename)
    {
        self::$msisdnFormatConfigFilename = $msisdnFormatConfigFilename;

        $parser = new Parser();

        self::$msisdnFormatData = $parser->parse(file_get_contents(self::$msisdnFormatConfigFilename));
    }

    public function getCountryPrefix($country)
    {
        $countryData = $this->getCountryData($country);
        return $countryData['prefix'];
    }

    public function getCountryRegexList($country)
    {
        $countryData = $this->getCountryData($country);
        return $countryData['regex'];
    }

    public function getCountryData($country)
    {
        if(!array_key_exists($country, self::$msisdnFormatData)) {
            throw new \Exception("No msisdn formatting data found for country '$country'.");
        }
        return self::$msisdnFormatData[$country];
    }
}
