<?php

namespace Domain\Repositories;

interface RetunMovieRepositoryInterface
{
    public function allReturnMovie();

    public function createReturnMovie($movieId, $clientId);

    public function findByIdMovie($movieId);

    public function updateReturnMovie($id, $movieId, $clientId);

    public function deleteReturnMovie($id);
}
