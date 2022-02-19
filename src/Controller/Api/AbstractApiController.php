<?php

namespace App\Controller\Api;

use App\Client\TmdbClientFactory;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiController extends AbstractController
{
    protected TmdbClientFactory $factory;
    protected SerializerInterface $serializer;

    public function __construct(TmdbClientFactory $factory, SerializerInterface $serializer)
    {
        $this->factory = $factory;
        $this->serializer = $serializer;
    }

    public function getJsonResponse(
        string $clientName,
        string $path,
        string $deserializationClass,
        array $options = [],
        array $serializationGroups = [],
        bool $isCollection = true
    ): JsonResponse
    {
        try {
            $response = $this->factory->getTmdbClient($clientName)->getRaw($path, $options);
            $deserializedResponse = $this->serializer->deserialize($response->getContent(), $deserializationClass, 'json');

            return new JsonResponse(
                $this->serializer->serialize(
                    $isCollection ? $deserializedResponse->getElements() : $deserializedResponse,
                    'json',
                    !empty($serializationGroups) ? SerializationContext::create()->setGroups($serializationGroups) : null
                ),
                Response::HTTP_OK,
                [],
                true
            );
        } catch (\Throwable $e) {
            return new JsonResponse($e->getMessage());
        }
    }
}
