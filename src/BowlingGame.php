<?php

namespace PF;

class BowlingGame
{
    // 7.4 failed
    private $rolls = [];

    public function roll(int $score): void
    {
        $this->rolls[] = $score;
    }

    public function getScore(): int
    {
        $score = 0;
        $roll = 0;

        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isStrike($roll)) {
                $score += 10 + $this->getStrikeBonus($roll);
                $roll++;
                continue;
            }

            if ($this->isSpare($roll)) {
                $score += $this->getSpareBonus($roll);
            }

            $score += $this->getNormalScore($roll);
            $roll += 2;
        }

        return $score;
    }

    public function getNormalScore(int $roll): int
    {
        return $this->rolls[$roll] + $this->rolls[$roll + 1];
    }

    public function isSpare(int $roll): bool
    {
        return $this->getNormalScore($roll) === 10;
    }

    public function getSpareBonus(int $roll): int
    {
        return $this->rolls[$roll + 2];
    }

    public function getStrikeBonus(int $roll): int
    {
        return $this->rolls[$roll + 1] + $this->rolls[$roll + 2];
    }

    public function isStrike(int $roll): bool
    {
        return $this->rolls[$roll] === 10;
    }
}