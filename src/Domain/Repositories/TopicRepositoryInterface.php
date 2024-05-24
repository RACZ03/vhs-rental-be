<?php

namespace Domain\Repositories;

interface TopicRepositoryInterface
{
    public function getAllTopics();

    public function createTopic($name);

    public function updateTopic($id, $name);

    public function deleteTopic($id);
}
