<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::in([3, 2])->assert(1),
    fn(string $message) => expect($message)->toBe('1 must be in `[3, 2]`'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::in('foobar'))->assert('foo'),
    fn(string $message) => expect($message)->toBe('"foo" must not be in "foobar"'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::in([2, '1', 3], true)->assert('2'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "2" must be in `[2, "1", 3]`'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::in([2, '1', 3], true))->assert('1'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1" must not be in `[2, "1", 3]`'),
));
