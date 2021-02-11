<?php

namespace Brain\Games\Engine;

use function cli\line;
use function cli\prompt;

const COUNT_OF_ANSWERS_FOR_WIN = 3;

function playGame(string $gameDescription, callable $getTask): void
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    line($gameDescription);

    for ($i = 0; $i < COUNT_OF_ANSWERS_FOR_WIN; $i += 1) {
        ['question' => $question, 'correctAnswer' => $correctAnswer] = $getTask();
        line("Question: ${question}");
        $actualAnswer = prompt('Your answer');
        if ($correctAnswer === $actualAnswer) {
            line('Correct!');
        } else {
            line("'${actualAnswer}' is wrong answer ;(. Correct answer was '${correctAnswer}'.");
            line('Let\'s try again, %s!', $name);
            return;
        }
    }
    line('Congratulations, %s!', $name);
}
