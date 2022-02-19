<?php

namespace App\Client;

use App\Model\Movie;
use App\Model\TmdbCollectionInterface;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class TmdbClient
{
    private HttpClientInterface $client;
    private string  $version;
    private SerializerInterface $serializer;
    private string $name;

    public function __construct(HttpClientInterface $client, string $version, SerializerInterface $serializer, string $name)
    {
        $this->client = $client;
        $this->version = $version;
        $this->serializer = $serializer;
        $this->name = $name;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function getRaw(string $url, array $options = []): ResponseInterface
    {
        return $this->client->request('GET', $this->getPath($url), $options);
    }

    public function get(string $url, string $deserializationClass, array $options = []): ?TmdbCollectionInterface
    {
        try {
            $response = $this->getRaw($url, $options);

            return $this->serializer->deserialize($response->getContent(), $deserializationClass, 'json');
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function getElements(string $url, string $deserializationClass, array $options = []): array
    {
        return $this->get($url, $deserializationClass, $options)->getElements() ?? [];
    }

    private function getPath($path): string
    {
        return sprintf('%s/%s/%s', $this->version, $this->name, $path);
    }
}
