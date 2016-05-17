<?php

namespace Turanct\Epsilon;

final class Option
{
    private $id;
    private $score;

    public function __construct($id, Score $score)
    {
        $this->id = $id;
        $this->score = $score;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getScore()
    {
        return $this->score;
    }
}
