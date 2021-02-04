<?php

namespace Brain\Games\Engine;

use function cli\line;
use function cli\prompt;

const COUNT_OF_ANSWERS_FOR_WIN = 3;

function askName(): string
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    return $name;
}

function checkAnswer(string $correctAnswer, string $actualAnswer): array
{
    if ($correctAnswer === $actualAnswer) {
        return [
            'isCorrect' => true,
            'phrase' => 'Correct!'
        ];
    } else {
        return [
            'isCorrect' => false,
            'phrase' => "'{$actualAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'."
        ];
    }
}

function printGameDescription(string $gameDescription): void
{
    line($gameDescription);
}

function printClosingPhrase(bool $isWin, string $name): void
{
    if ($isWin) {
        line('Congratulations, %s!', $name);
    } else {
        line('Let\'s try again, %s!', $name);
    }
}

function startGame(string $gameDescription, callable $getQuestionAndAnswer): void
{
    $name = askName();
    printGameDescription($gameDescription);

    $correctAnswerCount = 0;
    $isCorrect = true;
    while ($correctAnswerCount < COUNT_OF_ANSWERS_FOR_WIN && $isCorrect) {
        ['question' => $question, 'correctAnswer' => $correctAnswer] = $getQuestionAndAnswer();
        line("Question: {$question}");
        $answer = prompt('Your answer');
        ['isCorrect' => $isCorrect, 'phrase' => $phrase] = checkAnswer((string) $correctAnswer, $answer);
        line($phrase);
        $correctAnswerCount += 1;
    }
    printClosingPhrase($isCorrect, $name);
}
