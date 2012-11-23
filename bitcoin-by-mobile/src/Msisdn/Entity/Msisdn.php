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
use Msisdn\Entity\MsisdnFormat;

/**
 * @ExclusionPolicy("none")
 * @AccessType("public_method")
 */
class Msisdn {

    /**
     * @Type("string")
     * @Assert\NotBlank()
     */
    protected $msisdn;

    /**
     * @Type("\Msisdn\Entity\MsisdnFormat")
     */
    protected $msisdnFormat;

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

    public function asMobile()
    {
        return substr($this->msisdn, strlen($this->msisdnFormat->getInternationalPrefix()));
    }

    public function setMsisdnFormat(MsisdnFormat $msisdnFormat)
    {
        $this->msisdnFormat = $msisdnFormat;
    }

    public function getMsisdnFormat()
    {
        return $this->msisdnFormat;
    }
}
