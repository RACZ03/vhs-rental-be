<?php

namespace Infrastructure\Persistence;

use Domain\Repositories\LoanMovieRepositoryInterface;
use Config\Database;

class LoanMovieRepository implements LoanMovieRepositoryInterface
{
    private $connection;

    public function __construct()
    {

        $this->connection = Database::getConnection();
    }

    public function getAllLoanMovies()
    {
        $stmt = $this->connection->query("SELECT lm.id, lm.date_loan, lm.date_return, lm.movie_id, m.title AS movie_name, lm.client_id, CONCAT(c.name, ' ', c.lastname) AS client_name, lm.state, t.id AS topic_id, t.name_topic AS topic_name 
                                            FROM loan_movies lm
                                            JOIN movies m ON lm.movie_id = m.id
                                            JOIN topics t ON m.topic_id = t.id
                                            JOIN clients c ON lm.client_id = c.id ORDER BY lm.id DESC");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function createLoanMovie($movieId, $clientId, $loanDate, $returnDate)
    {
        $stmt = $this->connection->prepare("INSERT INTO loan_movies (movie_id, client_id, date_loan, date_return) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiss', $movieId, $clientId, $loanDate, $returnDate);
        $stmt->execute();

        $stmt = $this->connection->prepare("UPDATE movies SET available = 0 WHERE id = ?");
        $stmt->bind_param('i', $movieId);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Loan movie created successfully'];
    }

    public function findByIdMovie($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM movies WHERE id = ? AND state = 1  AND available = 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    public function updateLoanMovie($id, $movieId, $clientId, $loanDate, $returnDate)
    {
        $stmt = $this->connection->prepare("UPDATE loan_movies SET movie_id = ?, client_id = ?, date_loan = ?, date_return = ? WHERE id = ?");
        $stmt->bind_param('iissi', $movieId, $clientId, $loanDate, $returnDate, $id);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Loan movie updated successfully'];
    }

    public function deleteLoanMovie($id)
    {
        $stmt = $this->connection->prepare("UPDATE loan_movies SET state = 0 WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return ['status' => 'success', 'message' => 'Loan movie deleted successfully'];
    }
}
