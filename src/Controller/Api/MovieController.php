<?php

namespace App\Controller\Api;

use App\Client\TmdbClientFactory;
use App\Model\Movie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movie", name="movie_")
 */
class MovieController extends AbstractApiController
{
    /**
     * @Route("/{movieId}", name="detail", methods={"GET"})
     */
    public function detail(int $movieId): JsonResponse
    {
        return $this->getJsonResponse(
            TmdbClientFactory::MOVIE_CLIENT,
            $movieId,
            Movie::class,
            [],
            [],
            false
        );
    }
}
