<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::lessThan(12)->assert(21),
    fn(string $message) => expect($message)->toBe('21 must be less than 12'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::lessThan('today'))->assert('yesterday'),
    fn(string $message) => expect($message)->toBe('"yesterday" must not be less than "today"'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::lessThan('1988-09-09')->assert('2018-09-09'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "2018-09-09" must be less than "1988-09-09"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::lessThan('b'))->assert('a'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a" must not be less than "b"'),
));
