<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    private int $m_score1 = 0;

    private int $m_score2 = 0;

    public function __construct(
        private string $player1Name,
        private string $player2Name
    ) {
    }

    public function wonPoint(string $playerName): void
    {
        if ($this->isPlayer1($playerName)) {
            $this->incrementMScore1();
        } else {
            $this->incrementMScore2();
        }
    }

    public function getScore(): string
    {
        $score = '';
        if ($this->m_score1 === $this->m_score2) {
            $score = $this->convertEqualScoresToString();
        } elseif ($this->m_score1 >= 4 || $this->m_score2 >= 4) {
            $score = $this->convertWinningOrAdvantageScoresToString();
        } else {
            for ($i = 1; $i < 3; $i++) {
                $tempScore = $this->getTempScore($i);

                if ($i !== 1) {
                    $score .= '-';
                }
                
                $score .= $this->convertTempScoreToString($tempScore);
            }
        }
        return $score;
    }

    private function isPlayer1(string $playerName): bool
    {
        return $playerName === $this->player1Name;
    }

    private function incrementMScore1(): void
    {
        $this->m_score1++;
    }

    private function incrementMScore2(): void
    {
        $this->m_score2++;
    }

    private function getTempScore(int $i): int
    {
        return $i === 1 ? $this->m_score1 : $this->m_score2;
    }

    private function convertTempScoreToString(int $tempScore): string
    {
        return match ($tempScore) {
            0 => 'Love',
            1 => 'Fifteen',
            2 => 'Thirty',
            3 => 'Forty',
            default => '',
        };
    }

    private function convertEqualScoresToString(): string
    {
        return match ($this->m_score1) {
            0 => 'Love-All',
            1 => 'Fifteen-All',
            2 => 'Thirty-All',
            default => 'Deuce',
        };
    }

    private function convertWinningOrAdvantageScoresToString(): string
    {
        $score = '';
        $minusResult = $this->m_score1 - $this->m_score2;
        if ($minusResult === 1) {
            $score = 'Advantage ' . $this->player1Name;
        } elseif ($minusResult === -1) {
            $score = 'Advantage ' . $this->player2Name;
        } elseif ($minusResult >= 2) {
            $score = 'Win for ' . $this->player1Name;
        } else {
            $score = 'Win for ' . $this->player2Name;
        }

        return $score;
    }


}
