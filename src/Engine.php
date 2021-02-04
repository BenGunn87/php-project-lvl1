<?php

namespace Brain\Games\Engine;

use function cli\line;
use function cli\prompt;

const COUNT_OF_ANSWERS_FOR_WIN = 3;

function startGame(string $gameDescription, callable $getTask): void
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    line($gameDescription);

    $isFail = false;
    for ($i = 0; $i < COUNT_OF_ANSWERS_FOR_WIN; $i += 1) {
        ['question' => $question, 'correctAnswer' => $correctAnswer] = $getTask();
        line("Question: ${question}");
        $actualAnswer = prompt('Your answer');
        if ($correctAnswer === $actualAnswer) {
            line('Correct!');
        } else {
            $isFail = true;
            line("'${actualAnswer}' is wrong answer ;(. Correct answer was '${correctAnswer}'.");
            break;
        }
    }
    if ($isFail) {
        line('Let\'s try again, %s!', $name);
    } else {
        line('Congratulations, %s!', $name);
    }
}
