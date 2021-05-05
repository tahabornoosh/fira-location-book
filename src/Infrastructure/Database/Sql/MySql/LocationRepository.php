<?php

namespace Fira\Infrastructure\Database\Sql\Mysql;

use DateTimeImmutable;
use Fira\App\DependencyContainer;
use Fira\Domain\Entity\Entity;
use Fira\Domain\Entity\LocationEntity;
use Fira\Domain\Utility\Pager;
use Fira\Domain\Utility\Sort;
use RuntimeException;

class LocationRepository implements \Fira\Domain\Repository\LocationRepository
{
    protected string $name;
    protected float $latitude;
    protected float $longitude;
    protected string $category;
    protected ?string $description = null;
    public function getByName(string $name, Pager $pager, Sort $sort): array
    {
        // TODO: Implement getByName() method.
    }

    public function getByCategory(string $category, Pager $pager, Sort $sort): array
    {
        // TODO: Implement getByCategory() method.
    }

    public function registerEntity(Entity $entity): void
    {
        $this->name = $entity->getName();
        $this->latitude = $entity->getLatitude();
        $this->longitude = $entity->getLongitude();
        $this->category = $entity->getCategory();
        $this->description = $entity->getDescription();
    }

    public function save(): void
    {
        if($this->name != null) {
        $q = DependencyContainer::getSqlDriver()->insert("INSERT INTO location(name, latitude, longitude, desk, cat) VALUES ('{$this->name}', {$this->latitude}, {$this->longitude}, '{$this->description}', {$this->category})");
        if($q === FALSE) {
            throw new RuntimeException('Query Error');
        }
        }
    }

    public function getById(int $id): Entity
    {
        $rowData = DependencyContainer::getSqlDriver()->getRowById($id, 'location');
        $entity = new LocationEntity();
        $entity
            ->setId($rowData['id'])
            ->setName($rowData['name'])
            ->setCategory($rowData['category'])
            ->setDescription($rowData['description'])
            ->setLatitude($rowData['latitude'])
            ->setLongitude($rowData['longitude'])
            ->setCreatedAt(new DateTimeImmutable($rowData['created_at']));

        return $entity;
    }

    public function getByIds(array $id): array
    {
        // TODO: Implement getByIds() method.
    }

    public function delete(int $id): void
    {
        $q = DependencyContainer::getSqlDriver()->delete("DELETE FROM Location WHERE id={$id}");
        //return('DELETE FROM Location WHERE id=$id');
    }

    public function getNextid(): int
    {
        // TODO: Implement getNextid() method.
    }

    public function search(array $searchParams, Pager $pager, Sort $sort): array
    {
        // TODO: Implement search() method.
    }
}
