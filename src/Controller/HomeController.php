<?php

namespace App\Controller;

use App\Client\TmdbClientFactory;
use App\Model\GenreCollection;
use App\Model\MovieCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function index(TmdbClientFactory $factory): Response
    {
        /** @var GenreCollection $genres */
        $genres = $factory->getTmdbClient(TmdbClientFactory::GENRE_CLIENT)
            ->get('movie/list', GenreCollection::class);

        $genreForm = $this->buildGenreForm($genres);

        $searchForm = $this->createFormBuilder()
            ->add('search')
            ->getForm();

        $movies = $factory->getTmdbClient(TmdbClientFactory::MOVIE_CLIENT)
            ->getElements('top_rated', MovieCollection::class);

        $highlightedMovie = array_shift($movies);

        return $this->render('home/index.html.twig', [
            'movies' => $movies,
            'genreForm' => $genreForm->createView(),
            'highlightedMovie' => $highlightedMovie,
            'searchForm' => $searchForm->createView(),
        ]);
    }

    private function buildGenreForm(GenreCollection $genreCollection): FormInterface
    {
        return $this->createFormBuilder($genreCollection)
            ->add('genres', ChoiceType::class,[
                'choices' => $genreCollection->getElements(),
                'choice_label' => 'name',
                'choice_value' => 'id',
                'expanded' => true,
                'multiple' => false,
                'mapped' => false
            ])->getForm();
    }
}
