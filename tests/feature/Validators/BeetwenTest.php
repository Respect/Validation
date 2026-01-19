<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::between(1, 2)->assert(0),
    fn(string $message) => expect($message)->toBe('0 must be between 1 and 2'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::between('yesterday', 'tomorrow'))->assert('today'),
    fn(string $message) => expect($message)->toBe('"today" must not be between "yesterday" and "tomorrow"'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::between('a', 'c')->assert('d'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "d" must be between "a" and "c"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::between(-INF, INF))->assert(0),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 0 must not be between `-INF` and `INF`'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::not(v::between('a', 'b'))->assert('a'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a" must not be between "a" and "b"'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::not(v::between(1, 42))->assert(41),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 41 must not be between 1 and 42'),
));
