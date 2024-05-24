<?php

namespace Infrastructure\Persistence;

use Domain\Repositories\RetunMovieRepositoryInterface;
use Config\Database;

class ReturnMovieRepository implements RetunMovieRepositoryInterface
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function allReturnMovie()
    {
        $stmt = $this->connection->query("SELECT rt.id, m.title AS movie_name, rt.client_id, CONCAT(c.name, ' ', c.lastname) AS client_name, rt.state, t.id AS topic_id, t.name_topic AS topic_name 
                                          FROM return_movies rt
                                          JOIN movies m ON rt.movie_id = m.id
                                          JOIN topics t ON m.topic_id = t.id
                                          JOIN clients c ON rt.client_id = c.id Order by rt.id DESC");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function createReturnMovie($movieId, $clientId)
    {
        $returnDate = date('Y-m-d H:i:s');
        $stmt = $this->connection->prepare("INSERT INTO return_movies (movie_id, client_id, return_date) VALUES (?, ?, ?)");
        //fecha y hora del momento
        $stmt->bind_param('iis', $movieId, $clientId, $returnDate);
        $stmt->execute();

        $stmt = $this->connection->prepare("UPDATE movies SET available = 1 WHERE id = ?");
        $stmt->bind_param('i', $movieId);
        $stmt->execute();

        return ['status' => 'success', 'message' => 'Return movie created successfully'];
    }

    public function findByIdMovie($movieId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM movies WHERE id = ? AND available = 0 and state=1");
        $stmt->bind_param('i', $movieId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateReturnMovie($id, $movieId, $clientId)
    {
        $stmt = $this->connection->prepare("UPDATE return_movies SET movie_id = ?, client_id = ? WHERE id = ?");
        $stmt->bind_param('iisi', $movieId, $clientId, $id);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Return movie updated successfully'];
    }

    public function deleteReturnMovie($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM return_movies WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Return movie deleted successfully'];
    }
}
