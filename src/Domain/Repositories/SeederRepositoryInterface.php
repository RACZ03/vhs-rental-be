<?php

namespace Domain\Repositories;

interface SeederRepositoryInterface
{
    public function seedTable(string $tableName, string $username, string $password): void;
}
