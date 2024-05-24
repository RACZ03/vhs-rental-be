<?php

namespace Application\Services\Statistics;

use Domain\Services\Statistics\StatisticsService;

class AppStatisticsService
{
    private $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function getAllStatistics()
    {
        return $this->statisticsService->getAllStatistics();
    }
}