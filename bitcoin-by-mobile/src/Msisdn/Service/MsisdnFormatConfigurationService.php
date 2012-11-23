<?php

namespace Msisdn\Service;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Yaml\Parser;
use \XMLReader;
use Msisdn\Entity\MsisdnFormat;

class MsisdnFormatConfigurationService {

    public static $msisdnFormatConfigFilename;

    public static $msisdnFormatData;

    protected static $xml;

    protected static $countryFormats = array();

    public function __construct($msisdnFormatConfigFilename)
    {
        self::$msisdnFormatConfigFilename = $msisdnFormatConfigFilename;
        self::$xml = new XMLReader();
        self::$xml->open(self::$msisdnFormatConfigFilename);
    }

    public function get($country, $property = false)
    {

        if(!array_key_exists($country, self::$countryFormats)) {
            $this->setCountryData($country);
        }
        
        $msisdnFormat = self::$countryFormats[$country];

        if($property) {
            $method = 'get' . ucwords($property);
            return $msisdnFormat->$method();
        }
        
        return $msisdnFormat;
    }
    
    public function setCountryData($country)
    {
        $formats = array();
        $prefix = null;
        $nationalDialingPrefix = null;
        $exampleMobile = null;

        $xml = self::$xml;

        while($xml->read()) {

            if('country' === $xml->name) {

                // check this is the target country
                $xml->moveToAttribute('code');
                if($xml->value === $country) {

                    // save the prefix
                    if($xml->moveToAttribute('prefix')) {
                        $prefix = $xml->value;
                    }

                    // save the national dialing prefix
                    if($xml->moveToAttribute('nationalDialingPrefix')) {
                        $nationalDialingPrefix = $xml->value;
                    }

                    // save the example mobile number
                    if($xml->moveToAttribute('exampleMobile')) {
                        $exampleMobile = $xml->value;
                    }

                    // read everything, stopping at the format entities
                    while($xml->read()) {

                        // we found a format entity
                        if(XMLReader::ELEMENT === $xml->nodeType &&
                            'format' === $xml->name) {

                            // grab the regular expression
                            $xml->moveToAttribute('expression');
                            $formats[] = '/^' . $xml->value . '$/';
                        }

                        // stop if we've advanced beyond the target country
                        if('country' === $xml->name) {
                            break;
                        }
                    }
                    break;
                }
            }
        }

        $msisdnFormat = new MsisdnFormat();
        $msisdnFormat->setCountry($country);
        $msisdnFormat->setInternationalPrefix($prefix);
        $msisdnFormat->setFormats($formats);
        $msisdnFormat->setNationalDialingPrefix($nationalDialingPrefix);
        $msisdnFormat->setExampleMobile($exampleMobile);
        
        self::$countryFormats[$country] = $msisdnFormat;
    }

    public function __destruct() {
        self::$xml->close();
    }
}
