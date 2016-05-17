<?php

namespace Turanct\Epsilon;

interface Storage
{
    public function getOptionWithOffset();
    public function getHighestScoringOption();
    public function getAllOptions();
    public function numberOfOptions();
    public function reward(Option $option);
}
