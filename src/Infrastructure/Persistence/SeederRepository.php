<?php

namespace Infrastructure\Persistence;

use Domain\Repositories\SeederRepositoryInterface;
use Config\Database;

class SeederRepository implements SeederRepositoryInterface
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function seedTable(string $tableName, string $username, string $password): void
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) as count FROM $tableName WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc()['count'];

        if ($count == 0) {
            $stmt = $this->connection->prepare("INSERT INTO $tableName (username, password) VALUES (?, ?)");
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
        }
    }
}
