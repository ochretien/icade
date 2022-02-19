<?php

namespace App\Controller\Api;

use App\Client\TmdbClientFactory;
use App\Model\MovieCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/search", name="search_")
 */
class SearchController extends AbstractApiController
{
    /**
     * @Route("/movie/{searchQuery}", name="movie", methods={"GET"})
     */
    public function movie(string $searchQuery): JsonResponse
    {
        return $this->getJsonResponse(
            TmdbClientFactory::SEARCH_CLIENT,
            'movie',
            MovieCollection::class,
            ['query' => ['query' => \urlencode($searchQuery)]],
            ['search']
        );
    }
}
