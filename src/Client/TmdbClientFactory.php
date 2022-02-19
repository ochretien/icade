<?php

namespace App\Client;

use JMS\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TmdbClientFactory
{
    public const MOVIE_CLIENT = 'movie';
    public const GENRE_CLIENT = 'genre';
    public const SEARCH_CLIENT = 'search';
    public const DISCOVER_CLIENT = 'discover';

    private HttpClientInterface $client;
    private string $version;
    private SerializerInterface $serializer;

    public function __construct(HttpClientInterface $client, string $version, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->version = $version;
        $this->serializer = $serializer;
    }

    public function getTmdbClient(string $name): TmdbClient
    {
        return new TmdbClient($this->client, $this->version, $this->serializer, $name);
    }
}
