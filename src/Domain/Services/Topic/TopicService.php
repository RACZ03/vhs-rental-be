<?php

namespace Domain\Services\Topic;

use Domain\Repositories\TopicRepositoryInterface;

class TopicService
{
    private $topicRepository;

    public function __construct(TopicRepositoryInterface $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function getAllTopics()
    {
        return $this->topicRepository->getAllTopics();
    }

    public function createTopic($name)
    {
        return $this->topicRepository->createTopic($name);
    }

    public function updateTopic($id, $name)
    {
        return $this->topicRepository->updateTopic($id, $name);
    }

    public function deleteTopic($id)
    {
        return $this->topicRepository->deleteTopic($id);
    }
}
