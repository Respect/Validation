<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::objectType()->assert([]),
    fn(string $message) => expect($message)->toBe('`[]` must be an object'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::objectType())->assert(new stdClass()),
    fn(string $message) => expect($message)->toBe('`stdClass {}` must not be an object'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::objectType()->assert('test'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "test" must be an object'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::objectType())->assert(new ArrayObject()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `ArrayObject { getArrayCopy() => [] }` must not be an object'),
));
