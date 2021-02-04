<?php

namespace Brain\Games\Games\EvenGame;

use function Brain\Games\Engine\startGame;

const ANSWER_YES = 'yes';
const ANSWER_NO = 'no';
const MIN_NUMBER = 1;
const MAX_NUMBER = 100;

function getQuestionAndAnswerGenerator(): callable
{
    return function (): array {
        $question = rand(MIN_NUMBER, MAX_NUMBER);
        $isEven = $question % 2 === 0;
        $correctAnswer = $isEven ? ANSWER_YES : ANSWER_NO;
        return [
            'question' => (string) $question,
            'correctAnswer' => $correctAnswer
        ];
    };
}

function getGameDescription(): string
{
    return 'Answer "' . ANSWER_YES . '" if the number is even, otherwise answer "' . ANSWER_NO . '".';
}

function startEvenGame(): void
{
    startGame(getGameDescription(), getQuestionAndAnswerGenerator());
}
