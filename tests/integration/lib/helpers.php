<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;

function exceptionMessage(callable $callable): void
{
    try {
        $callable();
    } catch (ValidationException $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
}

/**
 * @param array<string, array<string, string>> $templates
 */
function exceptionMessages(callable $callable, array $templates = []): void
{
    try {
        $callable();
    } catch (NestedValidationException $exception) {
        print_r($exception->getMessages($templates));
    }
}

function exceptionFullMessage(callable $callable): void
{
    try {
        $callable();
    } catch (NestedValidationException $exception) {
        echo $exception->getFullMessage() . PHP_EOL;
    }
}
