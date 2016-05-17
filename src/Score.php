<?php

namespace Turanct\Epsilon;

final class Score
{
    private $score;

    public function __construct($score)
    {
        if (!is_int($score) || $score < 0) {
            throw new InvalidArgumentException('Score must be a positive integer');
        }

        $this->score = $score;
    }

    public function getScore()
    {
        return $this->score;
    }
}
