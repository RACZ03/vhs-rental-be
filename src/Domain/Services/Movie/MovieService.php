<?php

namespace Domain\Services\Movie;

use Domain\Repositories\MovieRepositoryInterface;

class MovieService
{
    private $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getAllMovies()
    {
        return $this->movieRepository->getAllMovies();
    }

    public function getMoviesByTopic($id)
    {
        return $this->movieRepository->getMoviesByTopic($id);
    }

    public function findByIdMovie($id)
    {
        return $this->movieRepository->findByIdMovie($id);
    }

    public function createMovie($title, $year, $summary, $available, $topicId)
    {
        return $this->movieRepository->createMovie($title, $year, $summary, $available, $topicId);
    }

    public function updateMovie($id, $title, $year, $summary, $available, $topicId)
    {
        return $this->movieRepository->updateMovie($id, $title, $year, $summary, $available, $topicId);
    }

    public function deleteMovie($id)
    {
        return $this->movieRepository->deleteMovie($id);
    }
}
