<?php

namespace RestApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Guzzle\Service\Exception\ValidationException;
use RestApi\Exception\StatusCodeInterface;
use RestApi\Exception\RestApiException;
use RestApi\Exception\UuidUriEntityNotFoundRestApiException;
use RestApi\Exception\SerializableExceptionInterface;
use RestApi\Entity\ResponseEntity;
use RestApi\Entity\RestApiExceptionEntity;
class RestApiController extends Controller {

    public function executeThrowableCallback($callback)
    {
        try {
            $response = $callback($this);
        } catch(\Exception $e) {

            $statusCode = ($e instanceof StatusCodeInterface) ?
                $e->getHttpStatusCode() : RestApiException::HTTP_STATUS_CODE_DEFAULT;

            $response = $this->buildExceptionResponse($e, $statusCode);
        }

        return $response;
    }
    
    public function buildSerializedEntityResponse($entity, $statusCode = 200)
    {
        return $this->buildSuccessfulResponse($entity, $statusCode);
    }

    public function buildExceptionResponse(\Exception $exception, $statusCode = 500)
    {
        
        $response = new ResponseEntity();
        $response->setSuccess(false);

        $mapToEntity = ($exception instanceof SerializableExceptionInterface) ?
                $exception->getSerializationEntityClassName() : '\RestApi\Entity\RestApiExceptionEntity';
        
        $exceptionEntity = new $mapToEntity($exception);
        $response->setReturn($exceptionEntity);

        $serializer = $this->container->get('serializer');
        $json = $serializer->serialize($response, 'json');

        return $this->buildJsonResponse($json, $statusCode);
    }

    public function buildSuccessfulResponse($return = null, $statusCode = 200)
    {

        $response = new ResponseEntity();
        $response->setReturn($return);

        $serializer = $this->container->get('serializer');
        $json = $serializer->serialize($response, 'json');

        return $this->buildJsonResponse($json, $statusCode);
    }

    public function buildJsonResponse($json, $statusCode = 200)
    {
        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode($statusCode);
        return $response;
    }

    public function getService($serviceName)
    {
        return $this->container->get($serviceName);
    }

    public function &getContainer()
    {
        return $this->container;
    }
}
