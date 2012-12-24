<?php

namespace WalletBit\Entity;

use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Exclude;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\AccessType;
use JMS\SerializerBundle\Annotation\ReadOnly;
use JMS\SerializerBundle\Annotation\SerializedName;
    
/**
 * @AccessType("public_method")
 * @ExclusionPolicy("none")
 */
class PrepareTransferResponse {

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

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
