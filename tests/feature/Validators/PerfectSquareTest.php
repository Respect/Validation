<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::perfectSquare()->assert(250),
    fn(string $message) => expect($message)->toBe('250 must be a perfect square number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::perfectSquare())->assert(9),
    fn(string $message) => expect($message)->toBe('9 must not be a perfect square number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::perfectSquare()->assert(7),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 7 must be a perfect square number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::perfectSquare())->assert(400),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 400 must not be a perfect square number'),
));
