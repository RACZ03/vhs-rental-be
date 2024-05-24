<?php

namespace Domain\Services\Statistics;

use Domain\Repositories\StatisticsRepositoryInterface;


class StatisticsService
{
    private $statisticsRepository;

    public function __construct(StatisticsRepositoryInterface $statisticsRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
    }

    public function getAllStatistics()
    {
        return $this->statisticsRepository->getAllStatistics();
    }
}