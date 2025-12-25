<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame2 implements TennisGame
{
    private int $player1Point = 0;

    private int $player2Point = 0;

    private string $player1Result = '';

    private string $player2Result = '';

    public function __construct(
        private string $player1Name,
        private string $player2Name
    ) {
    }

    public function getScore(): string
    {
        $score = '';
        if ($this->player1Point === $this->player2Point) {
            $score = $this->convertEqualityScoreToString($this->player1Point);
        }

        if ($this->player1Point !== $this->player2Point && max($this->player1Point, $this->player2Point) < 4) {
            $this->player1Result = $this->convertScoreToString($this->player1Point);
            $this->player2Result = $this->convertScoreToString($this->player2Point);
            $score = "{$this->player1Result}-{$this->player2Result}";
        }

        if ($this->player1Point > $this->player2Point && $this->player2Point >= 3) {
            $score = 'Advantage ' . $this->player1Name;
        }

        if ($this->player2Point > $this->player1Point && $this->player1Point >= 3) {
            $score = 'Advantage ' . $this->player2Name;
        }

        if ($this->player1Point >= 4 && $this->player2Point >= 0 && ($this->player1Point - $this->player2Point) >= 2) {
            $score = 'Win for ' . $this->player1Name;
        }

        if ($this->player2Point >= 4 && $this->player1Point >= 0 && ($this->player2Point - $this->player1Point) >= 2) {
            $score = 'Win for ' . $this->player2Name;
        }

        return $score;
    }

    public function wonPoint(string $player): void
    {
        if ($player === $this->player1Name) {
            $this->incrementPlayer1Score();
        } else {
            $this->incrementPlayer2Score();
        }
    }

    private function incrementPlayer1Score(): void
    {
        $this->player1Point++;
    }

    private function incrementPlayer2Score(): void
    {
        $this->player2Point++;
    }

    private function convertScoreToString(int $score): string 
    {
        return match($score) {
            0 => 'Love',
            1 => 'Fifteen',
            2 => 'Thirty',
            3 => 'Forty',
            default => '',
        };
    }

    private function convertEqualityScoreToString(int $score): string 
    {
        return match($score) {
            0 => 'Love-All',
            1 => 'Fifteen-All',
            2 => 'Thirty-All',
            default => 'Deuce',
        };
    }
}
