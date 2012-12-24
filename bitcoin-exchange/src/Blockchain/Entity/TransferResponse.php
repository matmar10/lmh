<?php

namespace Blockchain\Entity;

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
class TransferResponse {

    /**
     * @Type("string")
     */
    protected $message;

    /**
     * @Type("string")
     * @SerializedName("tx_hash")
     */
    protected $txHash;

    /**
     * @Type("string")
     */
    protected $error;

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setTxHash($txHash)
    {
        $this->txHash = $txHash;
    }

    public function getTxHash()
    {
        return $this->txHash;
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
