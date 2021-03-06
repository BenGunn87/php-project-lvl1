<?php

namespace Brain\Games\Games\Even;

use function Brain\Games\Engine\playGame;

const ANSWER_YES = 'yes';
const ANSWER_NO = 'no';
const MIN_NUMBER = 1;
const MAX_NUMBER = 100;
const GAME_DESCRIPTION = 'Answer "' . ANSWER_YES . '" if the number is even, otherwise answer "' . ANSWER_NO . '".';

function getTaskGenerator(): callable
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

function startEvenGame(): void
{
    playGame(GAME_DESCRIPTION, getTaskGenerator());
}
