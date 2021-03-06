<?php

use PF\BowlingGame;
use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
    public function testGetScore_withAllZeros_getScoreZero()
    {
        $game = new BowlingGame();

        for ($i = 0; $i < 20; $i++) {
            $game->roll(0);
        }

        $score = $game->getScore();

        self::assertEquals(0, $score);
    }

    public function testGetScore_withAllOnes_getScore20()
    {
        $game = new BowlingGame();

        for ($i = 0; $i < 20; $i++) {
            $game->roll(1);
        }

        $score = $game->getScore();

        self::assertEquals(20, $score);
    }

    public function testGetScore_withASpare_getScoreWithSpareBonus()
    {
        $game = new BowlingGame();

        $game->roll(2);
        $game->roll(8);
        $game->roll(5);
        // 2 + 8 + 5 + 5 + 17
        for ($i = 0; $i < 17; $i++) {
            $game->roll(1);
        }

        $score = $game->getScore();

        self::assertEquals(37, $score);
    }

    public function testGetScore_withAStrike_getScoreWithStrikeBonus()
    {
        $game = new BowlingGame();

        $game->roll(10);
        $game->roll(3);
        $game->roll(5);
        // 10 + 3 + 5 + 3 + 5
        for ($i = 0; $i < 16; $i++) {
            $game->roll(1);
        }

        $score = $game->getScore();

        self::assertEquals(42, $score);
    }

    public function testGetScore_withAComplicatedGame_getsCorrectScore()
    {
        $game = new BowlingGame();

        $game->roll(10);

        $game->roll(3);
        $game->roll(5);

        $game->roll(10);

        $game->roll(10);

        $game->roll(4);
        $game->roll(4);

        for ($i = 0; $i < 10; $i++) {
            $game->roll(1);
        }
        // 10 + 3 + 5 + 3 + 5 + 10 + 10 + 4 + 10 + 4 + 4 + 4 + 4 + 10

        $score = $game->getScore();

        self::assertEquals(86, $score);
    }

    public function testGetScore_withAPerfectGame_getScore300()
    {
        $game = new BowlingGame();

        for ($i = 0; $i < 12; $i++) {
            $game->roll(10);
        }

        $score = $game->getScore();

        self::assertEquals(300, $score);
    }

    public function testRoll_withNegativeRollScore_throwsException()
    {
        $game = new BowlingGame();

        self::expectException(Exception::class);

        $game->roll(-1);
    }

    public function testRoll_withRollScore11_throwsException()
    {
        $game = new BowlingGame();

        self::expectException(Exception::class);

        $game->roll(11);
    }

    public function testGetScore_with25Rolls_throwsException()
    {
        $game = new BowlingGame();

        for ($i = 0; $i < 25; $i++) {
            $game->roll(1);
        }

        self::expectException(Exception::class);

        $game->getScore();
    }

    public function testGetScore_with5Rolls_throwsException()
    {
        $game = new BowlingGame();

        for ($i = 0; $i < 5; $i++) {
            $game->roll(1);
        }

        self::expectException(Exception::class);

        $game->getScore();
    }
}