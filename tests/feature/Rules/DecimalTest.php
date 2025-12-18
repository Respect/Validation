<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::decimal(3)->assert(0.1234),
    fn(string $message) => expect($message)->toBe('0.1234 must have 3 decimals')
));

test('Scenario #2', catchFullMessage(
    fn() => v::decimal(2)->assert(0.123),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 0.123 must have 2 decimals')
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::decimal(5))->assert(0.12345),
    fn(string $message) => expect($message)->toBe('0.12345 must not have 5 decimals')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::decimal(2))->assert(0.34),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 0.34 must not have 2 decimals')
));
