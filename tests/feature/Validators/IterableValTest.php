<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::iterableVal()->assert(3),
    fn(string $message) => expect($message)->toBe('3 must be iterable'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::iterableVal())->assert([2, 3]),
    fn(string $message) => expect($message)->toBe('`[2, 3]` must not be iterable'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::iterableVal()->assert('String'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "String" must be iterable'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::iterableVal())->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must not be iterable'),
));
