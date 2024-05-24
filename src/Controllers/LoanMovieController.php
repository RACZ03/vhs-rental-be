<?php

namespace Controllers;

use Application\Services\LoanMovie\AppLoanMovieService;
use Domain\Services\LoanMovie\LoanMovieService;
use Infrastructure\Persistence\LoanMovieRepository;

class LoanMovieController
{
    private $AappLoanMovieService;

    public function __construct()
    {
        $loanMovieRepository = new LoanMovieRepository();
        $loanService = new LoanMovieService($loanMovieRepository);
        $this->AappLoanMovieService = new AppLoanMovieService($loanService);
    }

    public function index()
    {
        try {
            return $this->AappLoanMovieService->getAllLoanMovies();
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function store()
    {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $movieId = $requestData['movieId'] ?? null;
            $clientId = $requestData['clientId'] ?? null;
            $loanDate = $requestData['loanDate'] ?? null;
            $returnDate = $requestData['returnDate'] ?? null;
            if ($movieId === null || $clientId === null || $loanDate === null || $returnDate === null) {
                throw new \Exception("All fields are required.");
            }
            return $this->AappLoanMovieService->createLoanMovie($movieId, $clientId, $loanDate, $returnDate);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function update($id)
    {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $movieId = $requestData['movieId'] ?? null;
            $clientId = $requestData['clientId'] ?? null;
            $loanDate = $requestData['loanDate'] ?? null;
            $returnDate = $requestData['returnDate'] ?? null;
            if ($movieId === null || $clientId === null || $loanDate === null || $returnDate === null) {
                throw new \Exception("All fields are required.");
            }
            return $this->AappLoanMovieService->updateLoanMovie($id, $movieId, $clientId, $loanDate, $returnDate);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            return $this->AappLoanMovieService->deleteLoanMovie($id);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
