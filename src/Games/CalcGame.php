<?php

namespace Brain\Games\Games\CalcGame;

use function Brain\Games\Engine\startGame;

const MIN_NUMBER = 1;
const MAX_NUMBER = 100;
const PLUS = '+';
const MINUS = '-';
const MULTIPLY = '*';
const OPERATIONS_CHARS = [PLUS, MINUS, MULTIPLY];

function getOperations(int $operationIndex): array
{
    $operationChar = OPERATIONS_CHARS[$operationIndex];
    $operationsFn = [
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
        'operation' => $operationChar,
        'fn' => $operationsFn[$operationChar]
    ];
}
function getFnToGenerateQuestionAndAnswer(): callable
{
    return function (): array {
        $operationIndex = rand(0, count(OPERATIONS_CHARS) - 1);
        ['operation' => $operation, 'fn' => $fn] = getOperations($operationIndex);
        $firstOperand = rand(MIN_NUMBER, MAX_NUMBER);
        $secondOperand = rand(MIN_NUMBER, MAX_NUMBER);

        return [
            'question' => "{$firstOperand} {$operation} {$secondOperand}",
            'correctAnswer' => (string) $fn($firstOperand, $secondOperand)
        ];
    };
}

function getGameDescription(): string
{
    return 'What is the result of the expression?';
}

function startCalcGame(): void
{
    startGame(getGameDescription(), getFnToGenerateQuestionAndAnswer());
}
