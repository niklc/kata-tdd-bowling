<?php

namespace PF;

use Exception;

class BowlingGame
{
    private array $rolls = [];

    /**
     * @param int $score
     * @throws Exception
     */
    public function roll(int $score): void
    {
        if ($this->isNegativeNumber($score)) {
            throw new Exception();
        }

        if ($this->isRollScoreMoreThanMaximum($score)) {
            throw new Exception();
        }

        $this->rolls[] = $score;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getScore(): int
    {
        if ($this->hasLessThanMinimumPossibleRolls()) {
            throw new Exception();
        }

        if ($this->hasMoreThanMaximumPossibleRolls()) {
            throw new Exception();
        }

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

    private function isNegativeNumber(int $score): bool
    {
        return $score < 0;
    }

    private function isRollScoreMoreThanMaximum(int $score): bool
    {
        return $score > 10;
    }

    private function hasMoreThanMaximumPossibleRolls(): bool
    {
        return count($this->rolls) > 20;
    }

    private function hasLessThanMinimumPossibleRolls(): bool
    {
        return count($this->rolls) < 12;
    }
}