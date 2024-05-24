<?php

namespace Infrastructure\Persistence;

use Domain\Repositories\TopicRepositoryInterface;
use Config\Database;

class TopicRepository implements TopicRepositoryInterface
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function getAllTopics()
    {
        $stmt = $this->connection->query("SELECT * FROM topics WHERE state = 1");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function createTopic($name)
    {
        $stmt = $this->connection->prepare("INSERT INTO topics (name_topic) VALUES (?)");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Topic created successfully'];
    }

    public function updateTopic($id, $name)
    {
        $stmt = $this->connection->prepare("UPDATE topics SET name_topic = ? WHERE id = ?");
        $stmt->bind_param('si', $name, $id);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Topic updated successfully'];
    }

    public function deleteTopic($id)
    {
        $stmt = $this->connection->prepare("UPDATE topics SET state = 0 WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Topic deleted successfully'];
    }
}
