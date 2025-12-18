<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::factor(3)->assert(2),
    fn(string $message) => expect($message)->toBe('2 must be a factor of 3')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::factor(0))->assert(300),
    fn(string $message) => expect($message)->toBe('300 must not be a factor of 0')
));

test('Scenario #3', catchFullMessage(
    fn() => v::factor(5)->assert(3),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 3 must be a factor of 5')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::factor(6))->assert(1),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 1 must not be a factor of 6')
));
