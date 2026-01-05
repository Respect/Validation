<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::lessThanOrEqual(10)->assert(11),
    fn(string $message) => expect($message)->toBe('11 must be less than or equal to 10'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::lessThanOrEqual(10))->assert(5),
    fn(string $message) => expect($message)->toBe('5 must be greater than 10'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::lessThanOrEqual('today')->assert('tomorrow'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tomorrow" must be less than or equal to "today"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::lessThanOrEqual('b'))->assert('a'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a" must be greater than "b"'),
));
