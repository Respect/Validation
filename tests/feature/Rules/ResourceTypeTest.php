<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::resourceType()->assert('test'),
    fn(string $message) => expect($message)->toBe('"test" must be a resource'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::resourceType())->assert(tmpfile()),
    fn(string $message) => expect($message)->toBe('`resource <stream>` must not be a resource'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::resourceType()->assert([]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[]` must be a resource'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::resourceType())->assert(tmpfile()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `resource <stream>` must not be a resource'),
));
