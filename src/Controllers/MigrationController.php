<?php

namespace Controllers;

use Application\Services\Migration\ApplicationMigrationService;
use Infrastructure\Persistence\DatabaseManagerRepository;
use Domain\Services\Migration\MigrationService;

class MigrationController
{
    private $applicationMigrationService;

    public function __construct()
    {
        $migrationRepository = new DatabaseManagerRepository();
        $migrationService = new MigrationService($migrationRepository);
        $this->applicationMigrationService = new ApplicationMigrationService($migrationService);
    }

    public function migrate()
    {
        try {
            return $this->applicationMigrationService->migrate();
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
