<?php

namespace App\Repositories;

interface CustomerRepoInterface
{
    public function findBy(string $findBy): array;
}
