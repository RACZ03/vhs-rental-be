<?php

namespace Controllers;

use Application\Services\Topic\ApplicationTopicService;
use Infrastructure\Persistence\TopicRepository;
use Domain\Services\Topic\TopicService;

class TopicController
{
    private $applicationTopicService;

    public function __construct()
    {
        $topicRepository = new TopicRepository();
        $topicService = new TopicService($topicRepository);
        $this->applicationTopicService = new ApplicationTopicService($topicService);
    }

    public function index()
    {
        try {
            return $this->applicationTopicService->getAllTopics();
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function store()
    {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $name = $requestData['name'] ?? null;
            if ($name === null) {
                throw new \Exception("Name is required.");
            }
            return $this->applicationTopicService->createTopic($name);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function update($id)
    {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $name = $requestData['name'] ?? null;
            if ($name === null) {
                throw new \Exception("Name is required.");
            }
            return $this->applicationTopicService->updateTopic($id, $name);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            return $this->applicationTopicService->deleteTopic($id);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
