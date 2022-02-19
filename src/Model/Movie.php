<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

class Movie
{
    /**
     * Serializer\Type("integer")
     */
    private int $id;

    /**
     * @Serializer\Type("string")
     * @Serializer\Groups({"Default", "search"})
     */
    private string $title;

    /**
     * @Serializer\Type("float")
     */
    private float $voteAverage;

    /**
     * @Serializer\Type("integer")
     */
    private int $voteCount;

    /**
     * @Serializer\Type("string")
     */
    private string $overview;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getVoteAverage(): float
    {
        return $this->voteAverage;
    }

    public function setVoteAverage(float $voteAverage): self
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }

    public function getVoteCount(): int
    {
        return $this->voteCount;
    }

    public function setVoteCount(int $voteCount): self
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): self
    {
        $this->overview = $overview;

        return $this;
    }
}
