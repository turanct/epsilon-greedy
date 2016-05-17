<?php

namespace Turanct\Epsilon;

final class EpsilonGreedy
{
    private $storage;
    private $randomness;

    public function __construct(Storage $storage, Randomness $randomness)
    {
        $this->storage = $storage;
        $this->randomness = $randomness;
    }

    public function getAnOption()
    {
        if ($this->randomness->integerBetween(1, 10) === 1) {
            return $this->getRandomOption();
        }

        return $this->getHighestScoringOption();
    }

    private function getRandomOption()
    {
        $randomOffset = $this->randomness->integerBetween(1, $this->storage->numberOfOptions());

        return $this->storage->getOptionWithOffset($randomOffset);
    }

    private function getHighestScoringOption()
    {
        return $this->storage->getHighestScoringOption();
    }

    public function reward(Option $option)
    {
        $this->storage->reward($option);
    }
}
