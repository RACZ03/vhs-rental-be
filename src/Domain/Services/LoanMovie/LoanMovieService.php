<?php

namespace Domain\Services\LoanMovie;

use Domain\Repositories\LoanMovieRepositoryInterface;


class LoanMovieService
{
    private $loanMovieRepository;

    public function __construct(LoanMovieRepositoryInterface $loanMovieRepository)
    {
        $this->loanMovieRepository = $loanMovieRepository;
    }

    public function getAllLoanMovies()
    {
        return $this->loanMovieRepository->getAllLoanMovies();
    }

    public function createLoanMovie($movieId, $clientId, $loanDate, $returnDate)
    {
        return $this->loanMovieRepository->createLoanMovie($movieId, $clientId, $loanDate, $returnDate);
    }

    public function findByIdMovie($movieId)
    {
        return $this->loanMovieRepository->findByIdMovie($movieId);
    }

    public function updateLoanMovie($id, $movieId, $clientId, $loanDate, $returnDate)
    {
        return $this->loanMovieRepository->updateLoanMovie($id, $movieId, $clientId, $loanDate, $returnDate);
    }

    public function deleteLoanMovie($id)
    {
        return $this->loanMovieRepository->deleteLoanMovie($id);
    }
}
