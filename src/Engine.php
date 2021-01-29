<?php

namespace Brain\Games\Engine;

use function cli\line;
use function cli\prompt;

const NUMBER_OF_ANSWERS_TO_WIN = 3;

function hello()
{
    line('Welcome to the Brain Game!');
}

function askName(): string
{
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    return $name;
}

function checkAnswer($correctAnswer, $actualAnswer): array
{
    if ((string) $correctAnswer === (string) $actualAnswer) {
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

function printGameDescription($gameDescription)
{
    line($gameDescription);
}

function printClosingPhrase($isWin, $name)
{
    if ($isWin) {
        line('Congratulations, %s!', $name);
    } else {
        line('Let\'s try again, %s!', $name);
    }
}

function startGame($gameDescription, $getQuestion)
{
    hello();
    $name = askName();
    printGameDescription($gameDescription);

    $correctAnswerCount = 0;
    $isCorrect = true;
    while ($correctAnswerCount < NUMBER_OF_ANSWERS_TO_WIN && $isCorrect) {
        ['question' => $question, 'correctAnswer' => $correctAnswer] = $getQuestion();
        line($question);
        $answer = prompt('Your answer');
        ['isCorrect' => $isCorrect, 'phrase' => $phrase] = checkAnswer($correctAnswer, $answer);
        line($phrase);
        $correctAnswerCount += 1;
    }
    printClosingPhrase($isCorrect, $name);
}
