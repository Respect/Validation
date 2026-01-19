<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::fibonacci()->assert(4),
    fn(string $message) => expect($message)->toBe('4 must be a valid Fibonacci number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::fibonacci())->assert(5),
    fn(string $message) => expect($message)->toBe('5 must not be a valid Fibonacci number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::fibonacci()->assert(16),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 16 must be a valid Fibonacci number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::fibonacci())->assert(21),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 21 must not be a valid Fibonacci number'),
));
