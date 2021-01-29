<?php

namespace Brain\Games\Games\CalcGame;

use Closure;

use function Brain\Games\Engine\startGame;

const MIN_NUMBER = 1;
const MAX_NUMBER = 100;
const OPERATIONS_CHARS = ['+', '-', '*'];

function getOperations(): array
{
    $operations_fn = [
        '+' => function ($a, $b) {
            return $a + $b;
        },
        '-' => function ($a, $b) {
            return $a - $b;
        },
        '*' => function ($a, $b) {
            return $a * $b;
        },
    ];
    $operationIndex = rand(0, count(OPERATIONS_CHARS) - 1);
    $operation = OPERATIONS_CHARS[$operationIndex];
    return [
        'operation' => $operation,
        'fn' => $operations_fn[$operation]
    ];
}
function getQuestionFn(): Closure
{
    return function () {
        ['operation' => $operation, 'fn' => $fn] = getOperations();
        $firstOperand = rand(MIN_NUMBER, MAX_NUMBER);
        $secondOperand = rand(MIN_NUMBER, MAX_NUMBER);

        return [
            'question' => "Question: $firstOperand $operation $secondOperand",
            'correctAnswer' => $fn($firstOperand, $secondOperand)
        ];
    };
}

function getGameDescription(): string
{
    return 'What is the result of the expression?';
}

function startCalcGame()
{
    startGame(getGameDescription(), getQuestionFn());
}