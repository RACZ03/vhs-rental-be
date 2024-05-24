<?php

namespace Domain\Repositories;

interface MovieRepositoryInterface
{
    public function getAllMovies();
    public function getMoviesByTopic($id);
    public function findByIdMovie($id);
    public function createMovie($title, $year, $summary, $available, $topicId);
    public function updateMovie($id, $title, $year, $summary, $available, $topicId);
    public function deleteMovie($id);
}
