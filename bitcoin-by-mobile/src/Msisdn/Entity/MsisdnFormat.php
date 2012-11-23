<?php

namespace Msisdn\Entity;

use RestApi\Entity\UuidUriEntityBase;
use Doctrine\ORM\Mapping as ORM;
use JMS\SerializerBundle\Annotation\AccessType;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\ReadOnly;
use JMS\SerializerBundle\Annotation\Exclude;
use Lmh\UtilBundle\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ExclusionPolicy("none")
 * @AccessType("public_method")
 */
class MsisdnFormat {

    /**
     * @Type("string")
     */
    protected $country;

    /**
     * @Type("string")
     */
    protected $exampleMobile;

    /**
     * @Type("string")
     */
    protected $internationalPrefix;

    /**
     * @Type("string")
     */
    protected $nationalDialingPrefix;

    /**
     * @Type("Array")
     */
    protected $formats;

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function addFormat($format)
    {
        $this->formats[] = $format;    
    }

    public function setFormats(array $formats)
    {
        $this->formats = $formats;
    }

    public function getFormats()
    {
        return $this->formats;
    }

    public function setInternationalPrefix($internationalPrefix)
    {
        $this->internationalPrefix = $internationalPrefix;
    }

    public function getInternationalPrefix()
    {
        return $this->internationalPrefix;
    }

    public function setNationalDialingPrefix($nationalDialingPrefix)
    {
        $this->nationalDialingPrefix = $nationalDialingPrefix;
    }

    public function getNationalDialingPrefix()
    {
        return $this->nationalDialingPrefix;
    }

    public function setExampleMobile($exampleMobile)
    {
        $this->exampleMobile = $exampleMobile;
    }

    public function getExampleMobile()
    {
        return $this->exampleMobile;
    }
}
