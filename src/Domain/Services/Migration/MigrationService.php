<?php

namespace Domain\Services\Migration;

use Domain\Repositories\DatabaseManagerRepositoryInterface;

class MigrationService
{
    private $migrationRepository;

    public function __construct(DatabaseManagerRepositoryInterface $migrationRepository)
    {
        $this->migrationRepository = $migrationRepository;
    }

    public function migrate()
    {
        try {
            $tables = [
                'topics' => "CREATE TABLE IF NOT EXISTS topics (
                                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                name_topic VARCHAR(255) NOT NULL,
                                state TINYINT(1) DEFAULT 1
                            )",
                'movies' => "CREATE TABLE IF NOT EXISTS movies (
                                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                title VARCHAR(255) NOT NULL,
                                year INT(4) NOT NULL,
                                summary TEXT,
                                available BOOLEAN,
                                topic_id INT(6) UNSIGNED,
                                state TINYINT(1) DEFAULT 1,
                                FOREIGN KEY (topic_id) REFERENCES topics(id)
                            )",
                'clients' => "CREATE TABLE IF NOT EXISTS clients (
                                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                name VARCHAR(250) NOT NULL,
                                lastname VARCHAR(250) NOT NULL,
                                phone VARCHAR(20),
                                email VARCHAR(250),
                                state TINYINT(1) DEFAULT 1
                            )",
                'users' => "CREATE TABLE IF NOT EXISTS users (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                username VARCHAR(250) UNIQUE NOT NULL,
                                password VARCHAR(250) NOT NULL,
                                state TINYINT(1) DEFAULT 1
                            )",
                'loan_movies' => "CREATE TABLE IF NOT EXISTS loan_movies (
                                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    date_loan DATE,
                                    date_return DATE,
                                    movie_id INT(6),
                                    client_id INT(6),
                                    state TINYINT(1) DEFAULT 1
                                )",
                'return_movies' => "CREATE TABLE IF NOT EXISTS return_movies (
                                        client_id INT(6),
                                        movie_id INT(6),
                                        return_date DATETIME,
                                        state TINYINT(1) DEFAULT 1          
                                    )"
            ];

            foreach ($tables as $table => $query) {
                $this->migrationRepository->createTable($query);
            }

            return ['status' => 'success', 'message' => 'Tables created successfully'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
