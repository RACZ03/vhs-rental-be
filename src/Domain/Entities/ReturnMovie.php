<?php

namespace Domain\Entity;

class ReturnMovie
{
    private $clientId;
    private $movieId;

    public function __construct($clientId, $movieId)
    {
        $this->clientId = $clientId;
        $this->movieId = $movieId;
    }
}