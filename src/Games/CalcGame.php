<?php

namespace Brain\Games\Games\CalcGame;

use function Brain\Games\Engine\startGame;

const MIN_NUMBER = 1;
const MAX_NUMBER = 100;
const PLUS = '+';
const MINUS = '-';
const MULTIPLY = '*';
const OPERATIONS_SYMBOLS = [PLUS, MINUS, MULTIPLY];

function getQuestionAndAnswer(int $operationIndex, int $firstOperand, int $secondOperand): array
{
    $operationSymbol = OPERATIONS_SYMBOLS[$operationIndex];
    $operations = [
        PLUS => function ($a, $b) {
            return $a + $b;
        },
        MINUS => function ($a, $b) {
            return $a - $b;
        },
        MULTIPLY => function ($a, $b) {
            return $a * $b;
        },
    ];
    return [
        'question' => "{$firstOperand} {$operationSymbol} {$secondOperand}",
        'correctAnswer' => (string) $operations[$operationSymbol]($firstOperand, $secondOperand)
    ];
}
function getQuestionAndAnswerGenerator(): callable
{
    return function (): array {
        $operationIndex = rand(0, count(OPERATIONS_SYMBOLS) - 1);
        $firstOperand = rand(MIN_NUMBER, MAX_NUMBER);
        $secondOperand = rand(MIN_NUMBER, MAX_NUMBER);
        return getQuestionAndAnswer($operationIndex, $firstOperand, $secondOperand);
    };
}

function getGameDescription(): string
{
    return 'What is the result of the expression?';
}

function startCalcGame(): void
{
    startGame(getGameDescription(), getQuestionAndAnswerGenerator());
}
