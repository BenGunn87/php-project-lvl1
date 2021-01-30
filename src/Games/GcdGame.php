<?php

namespace Brain\Games\Games\GcdGame;

use Closure;

use function Brain\Games\Engine\startGame;

const MIN_NUMBER = 1;
const MAX_NUMBER = 50;

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

function getQuestionFn(): Closure
{
    return function (): array {
        $firstOperand = rand(MIN_NUMBER, MAX_NUMBER);
        $secondOperand = rand(MIN_NUMBER, MAX_NUMBER);

        return [
            'question' => "{$firstOperand} {$secondOperand}",
            'correctAnswer' => getGcd($firstOperand, $secondOperand)
        ];
    };
}

function getGameDescription(): string
{
    return 'Find the greatest common divisor of given numbers.';
}

function startGcdGame(): void
{
    startGame(getGameDescription(), getQuestionFn());
}
