<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

class Genre
{
    /**
     * @Serializer\Type("integer")
     */
    private int $id;

    /**
     * @Serializer\Type("string")
     */
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormValue(): int
    {
        return $this->getId();
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
