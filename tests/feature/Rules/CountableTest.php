<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::countable()->assert(1.0),
    fn(string $message) => expect($message)->toBe('1.0 must be a countable value')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::countable())->assert([]),
    fn(string $message) => expect($message)->toBe('`[]` must not be a countable value')
));

test('Scenario #3', catchFullMessage(
    fn() => v::countable()->assert('Not countable!'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "Not countable!" must be a countable value')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::countable())->assert(new ArrayObject()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `ArrayObject { getArrayCopy() => [] }` must not be a countable value')
));
