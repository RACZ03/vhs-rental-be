<?php

namespace Infrastructure\Persistence;

use Config\Database;
use Domain\Repositories\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function getAllMovies()
    {
        $stmt = $this->connection->query("SELECT * FROM movies WHERE state = 1 ORDER BY id DESC");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function getMoviesByTopic($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM movies WHERE topic_id = ? AND state = 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function findByIdMovie($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM movies WHERE id = ? AND state = 1  AND available = 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createMovie($title, $year, $summary, $available, $topicId)
    {
        $state = 1;
        $stmt = $this->connection->prepare("INSERT INTO movies (title, year, summary, available, topic_id, state) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sissii', $title, $year, $summary, $available, $topicId, $state);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Movie created successfully'];
    }

    public function updateMovie($id, $title, $year, $summary, $available, $topicId)
    {
        $stmt = $this->connection->prepare("UPDATE movies SET title = ?, year = ?, summary = ?, available = ?, topic_id = ? WHERE id = ?");
        $stmt->bind_param('sissii', $title, $year, $summary, $available, $topicId, $id);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Movie updated successfully'];
    }

    public function deleteMovie($id)
    {
        $stmt = $this->connection->prepare("UPDATE movies SET state = 0 WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Movie deleted successfully'];
    }
}
