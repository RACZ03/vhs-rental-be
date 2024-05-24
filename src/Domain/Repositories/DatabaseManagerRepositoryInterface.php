<?php

namespace Domain\Repositories;

interface DatabaseManagerRepositoryInterface
{
    public function tableExists($tableName);

    public function createTable($createQuery);
}
