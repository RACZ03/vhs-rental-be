<?php

namespace Application\Services\Seeder;

use Domain\Services\Seeder\SeederService;

class ApplicationSeederService
{
    private $seederService;

    public function __construct(SeederService $seederService)
    {
        $this->seederService = $seederService;
    }

    public function seed()
    {
        $result = $this->seederService->seed();
        return $result;
    }
}
