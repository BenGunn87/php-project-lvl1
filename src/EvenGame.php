<?php

namespace Brain\Games\EvenGame;

use function cli\line;
use function cli\prompt;

function getYesAnswer()
{
    return 'yes';
}

function getNoAnswer()
{
    return 'no';
}

function askName()
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    return $name;
}

function askQuestion()
{
    $min_number = 1;
    $max_number = 100;

    $questionNumber = rand($min_number, $max_number);
    line('Question: %s', $questionNumber);
    $answer = prompt('Your answer');

    $isEven = $questionNumber % 2 === 0;
    $correctAnswer = $isEven ? getYesAnswer() : getNoAnswer();
    if ($correctAnswer === $answer) {
        line('Correct!');
        return true;
    } else {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $correctAnswer);
        return false;
    }
}

function startGame()
{
    $maxCountCorrectAnswer = 3;
    $name = askName();
    line('Answer "%s" if the number is even, otherwise answer "%s".', getYesAnswer(), getNoAnswer());
    $correctAnswerCount = 0;
    while ($correctAnswerCount < $maxCountCorrectAnswer) {
        $isCorrect = askQuestion();
        $correctAnswerCount += $isCorrect ? 1 : 0;
    }
    line('Congratulations, %s!', $name);
}
