<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

class GenreCollection implements TmdbCollectionInterface
{
    /**
     * @Serializer\Type("array<App\Model\Genre>")
     */
    private array $genres = [];

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function setGenres(array $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    public function getElements(): array
    {
        return $this->getGenres();
    }
}
