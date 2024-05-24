<?php

namespace Infrastructure\Persistence;

use Domain\Repositories\StatisticsRepositoryInterface;
use Config\Database;

class MySQLStatisticsRepository implements StatisticsRepositoryInterface
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function getAllStatistics()
    {
        // Total de clientes registrados
        $stmt_clients = $this->connection->query("SELECT COUNT(*) AS total_clients FROM clients WHERE state = 1 ORDER BY id DESC");
        $total_clients = $stmt_clients->fetch_assoc()['total_clients'];

        // Total de películas rentadas
        $stmt_rented_movies = $this->connection->query("SELECT COUNT(*) AS total_rented_movies FROM movies WHERE available = false ORDER BY id DESC");
        $total_rented_movies = $stmt_rented_movies->fetch_assoc()['total_rented_movies'];

        // Total de películas disponibles
        $stmt_available_movies = $this->connection->query("SELECT COUNT(*) AS total_available_movies FROM movies WHERE available = true ORDER BY id DESC");
        $total_available_movies = $stmt_available_movies->fetch_assoc()['total_available_movies'];

        return [
            'total_clients' => $total_clients,
            'total_rented_movies' => $total_rented_movies,
            'total_available_movies' => $total_available_movies
        ];
    }
}
