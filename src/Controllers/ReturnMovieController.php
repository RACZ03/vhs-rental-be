<?php

namespace Controllers;

use Application\Services\ReturnMovie\AppReturnMovieService;
use Infrastructure\Persistence\ReturnMovieRepository;
use Domain\Services\ReturnMovie\ReturnMovieService;

class ReturnMovieController
{
    private $appReturnMovieService;

    public function __construct()
    {
        $returnMOvieRepository = new ReturnMovieRepository();
        $returnMovieService = new ReturnMovieService($returnMOvieRepository);
        $this->appReturnMovieService = new AppReturnMovieService($returnMovieService);
    }

    public function allReturnMovie()
    {
        try {
            return $this->appReturnMovieService->getAllReturnMovies();
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
            if ($movieId === null || $clientId === null) {
                throw new \Exception("All fields are required.");
            }
            return $this->appReturnMovieService->createReturnMovie($movieId, $clientId);
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
            if ($movieId === null || $clientId === null) {
                throw new \Exception("All fields are required.");
            }
            return $this->appReturnMovieService->updateReturnMovie($id, $movieId, $clientId);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function destroy($id)
    {
        try {
            return $this->appReturnMovieService->deleteReturnMovie($id);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
