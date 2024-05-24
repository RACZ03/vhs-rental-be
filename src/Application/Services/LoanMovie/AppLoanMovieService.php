<?php

namespace Application\Services\LoanMovie;

use Domain\Services\LoanMovie\LoanMovieService;

class AppLoanMovieService
{
    private $loanMovieService;

    public function __construct(LoanMovieService $loanMovieService)
    {
        $this->loanMovieService = $loanMovieService;
    }

    public function getAllLoanMovies()
    {
        return $this->loanMovieService->getAllLoanMovies();
    }

    public function createLoanMovie($movieId, $clientId, $loanDate, $returnDate)
    {
        $movie = $this->loanMovieService->findByIdMovie($movieId);
        // Verificar si la película fue encontrada
        if ($movie === null) {
            return ['status' => 'error', 'message' => 'The movie is on loan.'];
        }

        // Verificar si la película está disponible
        if ($movie['available'] != 1) {
            return ['status' => 'error', 'message' => 'The movie is on loan.'];
        }

        return $this->loanMovieService->createLoanMovie($movieId, $clientId, $loanDate, $returnDate);
    }

    public function updateLoanMovie($id, $movieId, $clientId, $loanDate, $returnDate)
    {
        return $this->loanMovieService->updateLoanMovie($id, $movieId, $clientId, $loanDate, $returnDate);
    }

    public function deleteLoanMovie($id)
    {
        return $this->loanMovieService->deleteLoanMovie($id);
    }
}
