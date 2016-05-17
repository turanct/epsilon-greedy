<?php

namespace Turanct\Epsilon;

date_default_timezone_set('Europe/Brussels');

class EpsilonGreedyTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_returns_the_highest_scoring_option_9_out_of_10_times()
    {
        $highestScoringOption = new Option(1, new Score(10));

        $storage = $this->getMock('Turanct\\Epsilon\\Storage');
        $storage
            ->method('getHighestScoringOption')
            ->willReturn($highestScoringOption);

        $randomness = $this->getMock('Turanct\\Epsilon\\Randomness');
        $randomness
            ->method('integerBetween')
            ->willReturn(2);

        $greedy = new EpsilonGreedy($storage, $randomness);

        $option = $greedy->getAnOption();

        $this->assertEquals($highestScoringOption, $option);
    }

    public function test_it_returns_a_random_option_1_out_of_10_times()
    {
        $randomOption = new Option(2, new Score(5));

        $storage = $this->getMock('Turanct\\Epsilon\\Storage');
        $storage
            ->expects($this->once())
            ->method('getOptionWithOffset')
            ->with($this->equalTo(2))
            ->willReturn($randomOption);

        $randomness = $this->getMock('Turanct\\Epsilon\\Randomness');
        $randomness
            ->method('integerBetween')
            ->will($this->onConsecutiveCalls(1, 2));

        $greedy = new EpsilonGreedy($storage, $randomness);

        $option = $greedy->getAnOption();

        $this->assertEquals($randomOption, $option);
    }

    public function test_it_passes_rewards_on_to_the_storage()
    {
        $option = new Option(1, new Score(10));

        $storage = $this->getMock('Turanct\\Epsilon\\Storage');
        $storage
            ->expects($this->once())
            ->method('reward')
            ->with($this->equalTo($option));

        $randomness = $this->getMock('Turanct\\Epsilon\\Randomness');

        $greedy = new EpsilonGreedy($storage, $randomness);

        $greedy->reward($option);
    }
}
