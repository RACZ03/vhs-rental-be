<?php

namespace Application\Services\Migration;

use Domain\Services\Migration\MigrationService;

class ApplicationMigrationService
{
    private $migrationService;

    public function __construct(MigrationService $migrationService)
    {
        $this->migrationService = $migrationService;
    }

    public function migrate()
    {
        return $this->migrationService->migrate();
    }
}
