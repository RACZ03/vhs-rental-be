<?php

namespace Infrastructure\Persistence;

use Domain\Entities\User;
use Domain\Repositories\UserRepositoryInterface;
use Config\Database;

class MySQLUserRepository implements UserRepositoryInterface
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function findByUsername($username)
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE username = ? AND state = 1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new User($row['id'], $row['username'], $row['password']);
        }

        return null;
    }
}
