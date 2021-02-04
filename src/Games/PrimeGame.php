<?php

namespace Brain\Games\Games\PrimeGame;

use function Brain\Games\Engine\startGame;

const ANSWER_YES = 'yes';
const ANSWER_NO = 'no';
const MIN_NUMBER = 1;
const MAX_NUMBER = 500;

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

function getQuestionAndAnswerGenerator(): callable
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

function getGameDescription(): string
{
    return 'Answer "' . ANSWER_YES . '" if the number is prime. Otherwise answer "' . ANSWER_NO . '".';
}

function startPrimeGame(): void
{
    startGame(getGameDescription(), getQuestionAndAnswerGenerator());
}
