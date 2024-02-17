<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Symfony\Component\VarExporter\VarExporter;

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
