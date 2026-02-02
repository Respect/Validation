<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::punct()->assert('a'),
    fn(string $message) => expect($message)->toBe('"a" must consist only of punctuation characters'),
));

test('Scenario #2', catchMessage(
    fn() => v::punct('c')->assert('b'),
    fn(string $message) => expect($message)->toBe('"b" must consist only of punctuation characters or "c"'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::punct())->assert('.'),
    fn(string $message) => expect($message)->toBe('"." must not consist only of punctuation characters'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::punct('d'))->assert('?'),
    fn(string $message) => expect($message)->toBe('"?" must not consist only of punctuation characters or "d"'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::punct()->assert('e'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "e" must consist only of punctuation characters'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::punct('f')->assert('g'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "g" must consist only of punctuation characters or "f"'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::punct())->assert('!'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "!" must not consist only of punctuation characters'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::punct('h'))->assert(';'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- ";" must not consist only of punctuation characters or "h"'),
));
