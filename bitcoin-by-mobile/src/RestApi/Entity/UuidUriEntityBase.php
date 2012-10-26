<?php

namespace RestApi\Entity;

use Doctrine\ORM\Mapping as ORM;
use RestApi\Entity\UriEntityBase;
use JMS\SerializerBundle\Annotation\AccessType;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\ReadOnly;
use JMS\SerializerBundle\Annotation\Groups;
use Lmh\UtilBundle\Uuid;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 * @AccessType("public_method")
 * @ExclusionPolicy("none")
 */
abstract class UuidUriEntityBase extends UriEntityBase
{

    /**
     * @ORM\Column(type="string", length=36)
     * @Type("string")
     * @ReadOnly
     * @Groups({"uri"})
     */
    protected $uuid;

    /**
     * @ORM\PrePersist
     */
    public function setUuidValue()
    {
        $this->uuid = new Uuid();
    }

    public function setUuid($uuid)
    {
        if($uuid instanceof Uuid) {
            $this->uuid = new Uuid($uuid);
            return;
        }
        $this->uuid = $uuid;
    }

    public function getUuid()
    {
        if($this->uuid instanceof Uuid) {
            return $this->uuid->__toString();
        }
        return $this->uuid;
    }

    // default implementation requires at least a uuid to generate a route
    public function getUriRouteParameters()
    {
        return array(
            'uuid' => $this->uuid,
        );
    }
}