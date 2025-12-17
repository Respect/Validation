<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::stringType()->assert(42),
    fn(string $message) => expect($message)->toBe('42 must be a string'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::stringType())->assert('foo'),
    fn(string $message) => expect($message)->toBe('"foo" must not be a string'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::stringType()->assert(true),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `true` must be a string'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::stringType())->assert('bar'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "bar" must not be a string'),
));
