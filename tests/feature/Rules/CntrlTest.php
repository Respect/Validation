<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Scenario #1', catchMessage(
    fn() => v::control()->assert('16-50'),
    fn(string $message) => expect($message)->toBe('"16-50" must only contain control characters')
));

test('Scenario #2', catchMessage(
    fn() => v::control('16')->assert('16-50'),
    fn(string $message) => expect($message)->toBe('"16-50" must only contain control characters and "16"')
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::control())->assert("\n"),
    fn(string $message) => expect($message)->toBe('"\\n" must not contain control characters')
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::control('16'))->assert("16\n"),
    fn(string $message) => expect($message)->toBe('"16\\n" must not contain control characters or "16"')
));

test('Scenario #5', catchFullMessage(
    fn() => v::control()->assert('Foo'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "Foo" must only contain control characters')
));

test('Scenario #6', catchFullMessage(
    fn() => v::control('Bar')->assert('Foo'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "Foo" must only contain control characters and "Bar"')
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::control())->assert("\n"),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "\\n" must not contain control characters')
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::control('Bar'))->assert("Bar\n"),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "Bar\\n" must not contain control characters or "Bar"')
));
