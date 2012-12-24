<?php

namespace WalletBit\Entity;

use RestApi\Entity\UuidUriEntityBase;
use Doctrine\ORM\Mapping as ORM;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Exclude;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\AccessType;
use JMS\SerializerBundle\Annotation\ReadOnly;
use JMS\SerializerBundle\Annotation\SerializedName;
use Lmh\UtilBundle\Uuid;
    
/**
 * @AccessType("public_method")
 * @ExclusionPolicy("none")
 */
class TransferResponse {

    /**
     * @Type("integer")
     */
    protected $status;

    /**
     * @Type("string")
     */
    protected $message;

    /**
     * @Type("string")
     */
    protected $address;

}
