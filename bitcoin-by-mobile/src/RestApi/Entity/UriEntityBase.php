<?php

namespace RestApi\Entity;

use Doctrine\ORM\Mapping as ORM;
use RestApi\Entity\UriEntityInterface;
use JMS\SerializerBundle\Annotation\AccessType;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\ReadOnly;
use JMS\SerializerBundle\Annotation\Groups;
use JMS\SerializerBundle\Annotation\Exclude;
use Lmh\UtilBundle\Uuid;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 * @AccessType("public_method")
 * @ExclusionPolicy("none")
 */
abstract class UriEntityBase implements UriEntityInterface
{

    /**
     * @Exclude
     */
    protected $uriRouteId;

    /**
     * @Exclude
     */
    protected $uriRouteParameters;

    /**
     * @Type("string")
     * @Groups({"uri"})
     */
    protected $uri;

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setUriRouteId($routeId)
    {
        $this->uriRouteId = $routeId;
    }

    public function setUriRouteParameter($parameterKey, $parameterValue)
    {
        $this->uriRouteParameters[$parameterKey] = $parameterValue;
    }

    public function setUriRouteParameters($parameters)
    {
        $this->uriRouteParameters = $parameters;
    }

    public function getUriRouteParameters()
    {
        return $this->uriRouteParameters;
    }

}