<?php

namespace Domain\Entity;

class Movie
{
    private $id;
    private $title;
    private $year;
    private $summary;
    private $available;
    private $topicId;

    public function __construct($id, $title, $year, $summary, $available, $topicId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->year = $year;
        $this->summary = $summary;
        $this->available = $available;
        $this->topicId = $topicId;
    }
}
