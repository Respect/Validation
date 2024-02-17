<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;
use Symfony\Component\VarExporter\VarExporter;

use function Respect\Stringifier\stringify;

function exceptionMessage(callable $callable, string $fallbackMessage = 'No exception was thrown'): void
{
    try {
        $callable();
        echo $fallbackMessage . PHP_EOL;
    } catch (ValidationException $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
}

/**
 * @param array<string, array<string, string>> $templates
 */
function exceptionMessages(
    callable $callable,
    array $templates = [],
    string $fallbackMessage = 'No exception was thrown'
): void {
    try {
        $callable();
        echo $fallbackMessage . PHP_EOL;
    } catch (NestedValidationException $exception) {
        echo VarExporter::export($exception->getMessages($templates)) . PHP_EOL;
    }
}

function exceptionFullMessage(callable $callable, string $fallbackMessage = 'No exception was thrown'): void
{
    try {
        $callable();
        echo $fallbackMessage . PHP_EOL;
    } catch (NestedValidationException $exception) {
        echo $exception->getFullMessage() . PHP_EOL;
    }
}

/** @param array<string, array{Validator, mixed, null|string|array<string, mixed>}> $scenarios */
function run(array $scenarios): void
{
    foreach ($scenarios as $description => $data) {
        [$rule, $input, $template] = array_pad($data, 3, null);
        echo $description . PHP_EOL;
        echo str_repeat('⎺', strlen($description)) . PHP_EOL;

        if (is_string($template)) {
            $rule->setTemplate($template);
        }

        $fallbackMessage = 'No exception was thrown with: ' . stringify($input);

        exceptionMessage(static fn() => $rule->check($input), $fallbackMessage);
        exceptionFullMessage(static fn() => $rule->assert($input), $fallbackMessage);
        exceptionMessages(static fn() => $rule->assert($input), is_array($template) ? $template : [], $fallbackMessage);
        echo PHP_EOL;
    }
}
