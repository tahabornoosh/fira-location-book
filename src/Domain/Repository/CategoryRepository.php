<?php

namespace Fira\Domain\Repository;

use Fira\Domain\Utility\Pager;
use Fira\Domain\Utility\Sort;

interface CategoryRepository extends Repository
{
    public function getByName(string $name, Pager $pager, Sort $sort): array;

    public function search(array $searchParams, Pager $pager, Sort $sort): array;
}
