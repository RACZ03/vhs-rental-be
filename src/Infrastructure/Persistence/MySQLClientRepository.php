<?php

namespace Infrastructure\Persistence;

use Domain\Entities\Client;
use Domain\Repositories\ClientRepositoryInterface; // Add this import statement
use Config\Database;

class MySQLClientRepository implements ClientRepositoryInterface
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function getAllClient()
    {
        $stmt = $this->connection->query("SELECT * FROM clients WHERE state = 1");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function findByIdClient($id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM clients WHERE id = ? AND STATE = 1');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function findByEmail($email)
    {
        $stmt = $this->connection->prepare('SELECT * FROM clients WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return true;
        }

        return false;
    }

    public function createClient($name, $lastname, $phone, $email)
    {
        $stmt = $this->connection->prepare('INSERT INTO clients (name, lastname, phone, email) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $name, $lastname, $phone, $email);
        $stmt->execute();

        return ['status' => 'success', 'message' => 'Client created successfully'];
    }

    public function updateClient($id, $name, $lastname, $phone, $email)
    {
        $stmt = $this->connection->prepare('UPDATE clients SET name = ?, lastname = ?, phone = ?, email = ? WHERE id = ?');
        $stmt->bind_param('ssssi', $name, $lastname, $phone, $email, $id);
        $stmt->execute();

        return ['status' => 'success', 'message' => 'Client updated successfully'];
    }

    public function deleteClient($id)
    {
        $stmt = $this->connection->prepare('UPDATE clients set state=0 WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return ['status' => 'success', 'message' => 'Client deleted successfully'];
    }
}
