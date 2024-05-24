<?php

namespace Domain\Entity;

class LoanMovie
{
    private $id;
    private $dateLoan;
    private $dateReturn;
    private $movieId;
    private $clientId;

    public function __construct($id, $dateLoan, $dateReturn, $movieId, $clientId)
    {
        $this->id = $id;
        $this->dateLoan = $dateLoan;
        $this->dateReturn = $dateReturn;
        $this->movieId = $movieId;
        $this->clientId = $clientId;
    }
}