<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::primeNumber()->assert(10),
    fn(string $message) => expect($message)->toBe('10 must be a prime number')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::primeNumber())->assert(3),
    fn(string $message) => expect($message)->toBe('3 must not be a prime number')
));

test('Scenario #3', catchFullMessage(
    fn() => v::primeNumber()->assert('Foo'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "Foo" must be a prime number')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::primeNumber())->assert('+7'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "+7" must not be a prime number')
));
