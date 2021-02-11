<?php

namespace Brain\Games\Games\Gcd;

use function Brain\Games\Engine\playGame;

const MIN_NUMBER = 1;
const MAX_NUMBER = 50;
const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';

function getGcd(int $a, int $b): int
{
    while ($a % $b !== 0 && $b % $a !== 0) {
        if ($a > $b) {
            $a = $a % $b;
        } else {
            $b = $b % $a;
        }
    }
    return $a > $b ? $b : $a;
}

function getTaskGenerator(): callable
{
    return function (): array {
        $firstOperand = rand(MIN_NUMBER, MAX_NUMBER);
        $secondOperand = rand(MIN_NUMBER, MAX_NUMBER);

        return [
            'question' => "{$firstOperand} {$secondOperand}",
            'correctAnswer' => (string) getGcd($firstOperand, $secondOperand)
        ];
    };
}

function startGcdGame(): void
{
    playGame(GAME_DESCRIPTION, getTaskGenerator());
}
