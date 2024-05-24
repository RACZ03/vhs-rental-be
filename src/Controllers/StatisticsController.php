<?php

namespace Controllers;


use Infrastructure\Persistence\MySQLStatisticsRepository;
use Application\Services\Statistics\AppStatisticsService;
use Domain\Services\Statistics\StatisticsService;

class StatisticsController
{

    private $appStatisticsService;

    public function __construct()
    {
        $statisticsRepository = new MySQLStatisticsRepository();
        $stadisticsService = new StatisticsService($statisticsRepository);
        $this->appStatisticsService = new AppStatisticsService($stadisticsService);
    }

    public function index()
    {
        try {
            return $this->appStatisticsService->getAllStatistics();
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}