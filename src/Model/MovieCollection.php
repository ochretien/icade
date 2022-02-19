<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

class MovieCollection implements TmdbCollectionInterface
{
    /**
     * @Serializer\Type("array<App\Model\Movie>")
     */
    private array $results = [];

    public function getResults(): array
    {
        return $this->results;
    }

    public function setResults(array $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function getElements(): array
    {
        return $this->getResults();
    }
}
