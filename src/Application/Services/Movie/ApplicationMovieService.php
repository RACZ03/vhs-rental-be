<?php

namespace Application\Services\Movie;

use Domain\Services\Movie\MovieService;

class ApplicationMovieService
{
    private $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function getAllMovies()
    {
        $result = $this->movieService->getAllMovies();
        return $result;
    }

    public function getMoviesByTopic($id)
    {
        $result = $this->movieService->getMoviesByTopic($id);
        return $result;
    }

    public function findByIdMovie($id)
    {
        $result = $this->movieService->findByIdMovie($id);
        if ($result != null) {
            return $result;
        }
        return ['status' => 'error', 'message' => 'The film has been loaned'];
    }

    public function createMovie($title, $year, $summary, $available, $topicId)
    {
        $result = $this->movieService->createMovie($title, $year, $summary, $available, $topicId);
        return $result;
    }

    public function updateMovie($id, $title, $year, $summary, $available, $topicId)
    {
        $result = $this->movieService->updateMovie($id, $title, $year, $summary, $available, $topicId);
        return $result;
    }

    public function deleteMovie($id)
    {
        $result = $this->movieService->deleteMovie($id);
        return $result;
    }
}
