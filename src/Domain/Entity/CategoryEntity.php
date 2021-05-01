<?php

namespace Fira\Domain\Entity;

class CategoryEntity extends Entity
{
    protected string $name;
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string   $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

}
