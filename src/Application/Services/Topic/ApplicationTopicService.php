<?php

namespace Application\Services\Topic;

use Domain\Services\Topic\TopicService;

class ApplicationTopicService
{
    private $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }

    public function getAllTopics()
    {
        return $this->topicService->getAllTopics();
    }

    public function createTopic($name)
    {
        return $this->topicService->createTopic($name);
    }

    public function updateTopic($id, $name)
    {
        return $this->topicService->updateTopic($id, $name);
    }

    public function deleteTopic($id)
    {
        return $this->topicService->deleteTopic($id);
    }
}
