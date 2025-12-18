<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::scalarVal()->assert([]),
    fn(string $message) => expect($message)->toBe('`[]` must be a scalar value')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::scalarVal())->assert(true),
    fn(string $message) => expect($message)->toBe('`true` must not be a scalar value')
));

test('Scenario #3', catchFullMessage(
    fn() => v::scalarVal()->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must be a scalar value')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::scalarVal())->assert(42),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 42 must not be a scalar value')
));
