<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::odd()->assert(2),
    fn(string $message) => expect($message)->toBe('2 must be an odd number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::odd())->assert(7),
    fn(string $message) => expect($message)->toBe('7 must be an even number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::odd()->assert(2),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 2 must be an odd number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::odd())->assert(9),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 9 must be an even number'),
));
