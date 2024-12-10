<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Rule;
use Symfony\Component\VarExporter\VarExporter;

function heading(string $heading): void
{
    echo $heading . PHP_EOL;
    echo str_repeat('⎺', strlen($heading)) . PHP_EOL;
}

function exceptionAll(string $heading, callable $callable): void
{
    heading($heading);
    exceptionMessage($callable, 'No exception was thrown');
    exceptionFullMessage($callable, 'No exception was thrown');
    exceptionMessages($callable, 'No exception was thrown');
    echo PHP_EOL;
}

function exceptionMessage(callable $callable, string $fallbackMessage = 'No exception was thrown'): void
{
    try {
        $callable();
        echo $fallbackMessage . PHP_EOL;
    } catch (ValidationException $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
}

function exceptionMessages(callable $callable, string $fallbackMessage = 'No exception was thrown'): void
{
    try {
        $callable();
        echo $fallbackMessage . PHP_EOL;
    } catch (ValidationException $exception) {
        echo VarExporter::export($exception->getMessages()) . PHP_EOL;
    }
}

function exceptionFullMessage(callable $callable, string $fallbackMessage = 'No exception was thrown'): void
{
    try {
        $callable();
        echo $fallbackMessage . PHP_EOL;
    } catch (ValidationException $exception) {
        echo $exception->getFullMessage() . PHP_EOL;
    }
}

/** @param array<string, array{0: Rule, 1: mixed, 2?:string|array<string, mixed>}> $scenarios */
function run(array $scenarios): void
{
    foreach ($scenarios as $heading => $data) {
        [$rule, $input, $template] = array_pad($data, 3, null);
        exceptionAll($heading, static fn() => $rule->assert($input, $template));
    }
}
