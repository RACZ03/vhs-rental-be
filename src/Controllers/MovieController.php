<?php

namespace Controllers;

use Application\Services\Movie\ApplicationMovieService;
use Infrastructure\Persistence\MovieRepository;
use Domain\Services\Movie\MovieService;

class MovieController
{
    private $applicationMovieService;

    public function __construct()
    {
        $movieRepository = new MovieRepository();
        $movieService = new MovieService($movieRepository);
        $this->applicationMovieService = new ApplicationMovieService($movieService);
    }

    public function index()
    {
        try {
            return $this->applicationMovieService->getAllMovies();
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function findByIdTopic($id)
    {
        try {
            return $this->applicationMovieService->getMoviesByTopic($id);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function findByIdMovie($id)
    {
        try {
            return $this->applicationMovieService->findByIdMovie($id);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function store()
    {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $title = $requestData['title'] ?? null;
            $year = $requestData['year'] ?? null;
            $summary = $requestData['summary'] ?? null;
            $available = $requestData['available'] ?? null;
            $topicId = $requestData['topic_id'] ?? null;

            if (!$title || !$year || !$summary || !$available || !$topicId) {
                return ['status' => 'error', 'message' => 'Missing required fields'];
            }
            return $this->applicationMovieService->createMovie($title, $year, $summary, $available, $topicId);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function update($id)
    {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);

            $title = $requestData['title'] ?? null;
            $year = $requestData['year'] ?? null;
            $summary = $requestData['summary'] ?? null;
            $available = $requestData['available'] ?? null;
            $topicId = $requestData['topic_id'] ?? null;

            if (!$title || !$year || !$summary || !isset($available) || !$topicId) {
                return ['status' => 'error', 'message' => 'Missing required fields'];
            }

            return $this->applicationMovieService->updateMovie($id, $title, $year, $summary, $available, $topicId);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            return $this->applicationMovieService->deleteMovie($id);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
