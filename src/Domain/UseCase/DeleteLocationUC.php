<?php

namespace Fira\Domain\UseCase;

use Fira\Domain\Entity\LocationEntity;
use \Fira\Domain\Repository\LocationRepository;
use Webmozart\Assert\Assert;

class DeleteLocationUC implements UseCaseInterface
{
    private LocationEntity $entity;
    private LocationRepository $repo;
    private string $w; 

    public function __construct(LocationRepository $locationRepository, LocationEntity $locationEntity)
    {
        $this->entity = $locationEntity;
        $this->repo = $locationRepository;
    }

    public function validate(): void
    {
        Assert::notEmpty($this->entity->getId(), 'ID should not be empty!');
    }

    public function execute(): string
    {
        $this->validate();
        return($this->repo->delete($this->entity->getId()));
    }
}