<?php

namespace Domain\Repositories;

interface LoanMovieRepositoryInterface
{
    public function getAllLoanMovies();

    public function createLoanMovie($movieId, $clientId, $loanDate, $returnDate);

    public function findByIdMovie($movieId);

    public function updateLoanMovie($id, $movieId, $clientId, $loanDate, $returnDate);

    public function deleteLoanMovie($id);
}
