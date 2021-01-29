<?php

namespace Brain\Games\Games\ProgressionGame;

use Closure;

use function Brain\Games\Engine\startGame;

const MIN_NUMBER = 1;
const MAX_NUMBER = 30;
const MIN_ELEM_COUNT = 5;
const MAX_ELEM_COUNT = 10;

function getProgression($firstElem, $delta, $elementsCount): array
{
    $arr = [];
    $currentElem = $firstElem;
    for ($i = 0; $i < $elementsCount; $i += 1) {
        $arr[] = $currentElem;
        $currentElem = $currentElem + $delta;
    }
    return $arr;
}

function getQuestionFn(): Closure
{
    return function () {
        $firstElem = rand(MIN_NUMBER, MAX_NUMBER);
        $delta = rand(MIN_NUMBER, MAX_NUMBER);
        $elementsCount = rand(MIN_ELEM_COUNT, MAX_ELEM_COUNT);
        $progression = getProgression($firstElem, $delta, $elementsCount);
        $unknownElemIndex = rand(0, $elementsCount - 1);
        $correctAnswer = $progression[$unknownElemIndex];
        $progression[$unknownElemIndex] = '..';
        return [
            'question' => "Question: ". implode(' ', $progression),
            'correctAnswer' => $correctAnswer
        ];
    };
}

function getGameDescription(): string
{
    return 'What number is missing in the progression?';
}

function startProgressionGame()
{
    startGame(getGameDescription(), getQuestionFn());
}
