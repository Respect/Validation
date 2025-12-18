<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::number()->assert(acos(1.01)),
    fn(string $message) => expect($message)->toBe('`NaN` must be a valid number')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::number())->assert(42),
    fn(string $message) => expect($message)->toBe('42 must not be a number')
));

test('Scenario #3', catchFullMessage(
    fn() => v::number()->assert(NAN),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `NaN` must be a valid number')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::number())->assert(42),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 42 must not be a number')
));
