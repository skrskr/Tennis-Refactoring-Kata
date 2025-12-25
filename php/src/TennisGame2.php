<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame2 implements TennisGame
{
    private int $player1Point = 0;

    private int $player2Point = 0;

    private string $p1Result = '';

    private string $pResult = '';

    public function __construct(
        private string $player1Name,
        private string $player2Name
    ) {
    }

    public function getScore(): string
    {
        $score = '';
        if ($this->player1Point === $this->player2Point && $this->player1Point < 4) {
            if ($this->player1Point === 0) {
                $score = 'Love';
            }
            if ($this->player1Point === 1) {
                $score = 'Fifteen';
            }
            if ($this->player1Point === 2) {
                $score = 'Thirty';
            }
            $score .= '-All';
        }

        if ($this->player1Point === $this->player2Point && $this->player1Point >= 3) {
            $score = 'Deuce';
        }

        if ($this->player1Point > 0 && $this->player2Point === 0) {
            if ($this->player1Point === 1) {
                $this->p1Result = 'Fifteen';
            }
            if ($this->player1Point === 2) {
                $this->p1Result = 'Thirty';
            }
            if ($this->player1Point === 3) {
                $this->p1Result = 'Forty';
            }

            $this->pResult = 'Love';
            $score = "{$this->p1Result}-{$this->pResult}";
        }

        if ($this->player2Point > 0 && $this->player1Point === 0) {
            if ($this->player2Point === 1) {
                $this->pResult = 'Fifteen';
            }
            if ($this->player2Point === 2) {
                $this->pResult = 'Thirty';
            }
            if ($this->player2Point === 3) {
                $this->pResult = 'Forty';
            }
            $this->p1Result = 'Love';
            $score = "{$this->p1Result}-{$this->pResult}";
        }

        if ($this->player1Point > $this->player2Point && $this->player1Point < 4) {
            if ($this->player1Point === 2) {
                $this->p1Result = 'Thirty';
            }
            if ($this->player1Point === 3) {
                $this->p1Result = 'Forty';
            }
            if ($this->player2Point === 1) {
                $this->pResult = 'Fifteen';
            }
            if ($this->player2Point === 2) {
                $this->pResult = 'Thirty';
            }
            $score = "{$this->p1Result}-{$this->pResult}";
        }

        if ($this->player2Point > $this->player1Point && $this->player2Point < 4) {
            if ($this->player2Point === 2) {
                $this->pResult = 'Thirty';
            }
            if ($this->player2Point === 3) {
                $this->pResult = 'Forty';
            }
            if ($this->player1Point === 1) {
                $this->p1Result = 'Fifteen';
            }
            if ($this->player1Point === 2) {
                $this->p1Result = 'Thirty';
            }
            $score = "{$this->p1Result}-{$this->pResult}";
        }

        if ($this->player1Point > $this->player2Point && $this->player2Point >= 3) {
            $score = 'Advantage player1';
        }

        if ($this->player2Point > $this->player1Point && $this->player1Point >= 3) {
            $score = 'Advantage player2';
        }

        if ($this->player1Point >= 4 && $this->player2Point >= 0 && ($this->player1Point - $this->player2Point) >= 2) {
            $score = 'Win for player1';
        }

        if ($this->player2Point >= 4 && $this->player1Point >= 0 && ($this->player2Point - $this->player1Point) >= 2) {
            $score = 'Win for player2';
        }

        return $score;
    }

    public function wonPoint(string $player): void
    {
        if ($player === 'player1') {
            $this->P1Score();
        } else {
            $this->P2Score();
        }
    }

    private function SetP1Score(int $number): void
    {
        for ($i = 0; $i < $number; $i++) {
            $this->P1Score();
        }
    }

    private function SetP2Score(int $number): void
    {
        for ($i = 0; $i < $number; $i++) {
            $this->P2Score();
        }
    }

    private function P1Score(): void
    {
        $this->player1Point++;
    }

    private function P2Score(): void
    {
        $this->player2Point++;
    }
}
