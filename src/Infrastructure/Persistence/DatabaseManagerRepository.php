<?php

namespace Infrastructure\Persistence;

use Config\Database;
use Domain\Repositories\DatabaseManagerRepositoryInterface;

class DatabaseManagerRepository implements DatabaseManagerRepositoryInterface
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function tableExists($tableName)
    {
        $stmt = $this->connection->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'vhs_rental' AND TABLE_NAME = '$tableName'");
        return $stmt->num_rows > 0;
    }

    public function createTable($query)
    {
        return $this->connection->query($query);
    }
}
