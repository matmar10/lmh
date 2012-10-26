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
class Msisdn {


    /**
     * @Type("string")
     * @Assert\Country()
     */
    protected $country;

    /**
     * @Type("string")
     * @Assert\NotBlank()
     * @Assert\MinLength(2)
     * @Assert\MaxLength(2)
     */
    protected $countryPrefix;
    
    /**
     * @Type("string")
     * @Assert\NotBlank()
     */
    protected $msisdn;

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountryPrefix($countryPrefix)
    {
        $this->countryPrefix = $countryPrefix;
    }

    public function getCountryPrefix()
    {
        return $this->countryPrefix;
    }

    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    }

    public function getMsisdn()
    {
        return $this->msisdn;
    }

    public function __toString()
    {
        return $this->msisdn;
    }
}
