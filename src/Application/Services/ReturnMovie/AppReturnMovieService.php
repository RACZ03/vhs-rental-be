<?php

namespace Application\Services\ReturnMovie;

use Domain\Services\ReturnMovie\ReturnMovieService;

class AppReturnMovieService
{
    private $returnMovieService;

    public function __construct(ReturnMovieService $returnMovieService)
    {
        $this->returnMovieService = $returnMovieService;
    }

    //getAllReturnMovies
    public function getAllReturnMovies()
    {
        return $this->returnMovieService->allReturnMovie();
    }

    //createReturnMovie
    public function createReturnMovie($movieId, $clientId)
    {
        $movie = $this->returnMovieService->findByIdMovie($movieId);
        // Verificar si la película fue encontrada
        if ($movie === null) {
            return ['status' => 'error', 'message' => 'The movie has not been returned.'];
        }

        // Verificar si la película está disponible
        if (!isset($movie['available']) || $movie['available'] !== 0) {
            return ['status' => 'error', 'message' => 'The movie has not been returned.'];
        }

        return $this->returnMovieService->createReturnMovie($movieId, $clientId);
    }

    //updateReturnMovie
    public function updateReturnMovie($id, $movieId, $clientId)
    {
        return $this->returnMovieService->updateReturnMovie($id, $movieId, $clientId);
    }

    //deleteReturnMovie
    public function deleteReturnMovie($id)
    {
        return $this->returnMovieService->deleteReturnMovie($id);
    }
}
