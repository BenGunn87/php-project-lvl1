<?php

namespace Brain\Games\Games\Progression;

use function Brain\Games\Engine\playGame;

const MIN_NUMBER = 1;
const MAX_NUMBER = 30;
const MIN_ELEM_COUNT = 5;
const MAX_ELEM_COUNT = 10;
const UNKNOWN_ELEM_SUBSTITUTE = '..';
const GAME_DESCRIPTION = 'What number is missing in the progression?';


function getProgression(int $firstElem, int $delta, int $elementsCount): array
{
    $progression = [];
    for ($i = 0; $i < $elementsCount; $i += 1) {
        $progression[] = $firstElem + $delta * $i;
    }
    return $progression;
}

function getTaskGenerator(): callable
{
    return function (): array {
        $firstElem = rand(MIN_NUMBER, MAX_NUMBER);
        $delta = rand(MIN_NUMBER, MAX_NUMBER);
        $elementsCount = rand(MIN_ELEM_COUNT, MAX_ELEM_COUNT);
        $progression = getProgression($firstElem, $delta, $elementsCount);
        $unknownElemIndex = rand(0, $elementsCount - 1);
        $correctAnswer = $progression[$unknownElemIndex];
        $progression[$unknownElemIndex] = UNKNOWN_ELEM_SUBSTITUTE;
        return [
            'question' => implode(' ', $progression),
            'correctAnswer' => (string) $correctAnswer
        ];
    };
}

function startProgressionGame(): void
{
    playGame(GAME_DESCRIPTION, getTaskGenerator());
}
