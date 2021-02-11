<?php

namespace Brain\Games\Games\Prime;

use function Brain\Games\Engine\playGame;

const ANSWER_YES = 'yes';
const ANSWER_NO = 'no';
const MIN_NUMBER = 1;
const MAX_NUMBER = 500;
const GAME_DESCRIPTION = 'Answer "' . ANSWER_YES . '" if the number is prime. Otherwise answer "' . ANSWER_NO . '".';

function isPrime(int $number): bool
{
    if ($number < 2) {
        return false;
    }
    $end = sqrt($number);
    for ($i = 2; $i <= $end; $i += 1) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}

function getTaskGenerator(): callable
{
    return function (): array {
        $question = rand(MIN_NUMBER, MAX_NUMBER);
        $correctAnswer = isPrime($question) ? ANSWER_YES : ANSWER_NO;
        return [
            'question' => (string) $question,
            'correctAnswer' => $correctAnswer
        ];
    };
}

function startPrimeGame(): void
{
    playGame(GAME_DESCRIPTION, getTaskGenerator());
}
