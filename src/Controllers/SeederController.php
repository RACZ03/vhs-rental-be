<?php

namespace Controllers;

use Application\Services\Seeder\ApplicationSeederService;
use Infrastructure\Persistence\SeederRepository;
use Domain\Services\Seeder\SeederService;

class SeederController
{
    private $applicationSeederService;

    public function __construct()
    {
        $seederRepository = new SeederRepository();
        $seederService = new SeederService($seederRepository);
        $this->applicationSeederService = new ApplicationSeederService($seederService);
    }

    public function seed()
    {
        try {
            return $this->applicationSeederService->seed();
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
