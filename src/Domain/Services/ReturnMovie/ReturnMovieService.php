<?php

namespace Domain\Services\ReturnMovie;

use Domain\Repositories\RetunMovieRepositoryInterface;

class ReturnMovieService
{
    private $retunMovieRepository;

    public function __construct(RetunMovieRepositoryInterface $retunMovieRepositoryInterface)
    {
        $this->retunMovieRepository = $retunMovieRepositoryInterface;
    }

    public function allReturnMovie()
    {
        return $this->retunMovieRepository->allReturnMovie();
    }

    public function createReturnMovie($ClientId, $MovieId)
    {
        return $this->retunMovieRepository->createReturnMovie($ClientId, $MovieId);
    }

    public function findByIdMovie($id)
    {
        return $this->retunMovieRepository->findByIdMovie($id);
    }

    public function updateReturnMovie($id, $ClientId, $MovieId)
    {
        return $this->retunMovieRepository->updateReturnMovie($id, $ClientId, $MovieId);
    }

    public function deleteReturnMovie($id)
    {
        return $this->retunMovieRepository->deleteReturnMovie($id);
    }
}
