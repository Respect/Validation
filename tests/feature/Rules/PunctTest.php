<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::punct()->assert('a'),
    fn(string $message) => expect($message)->toBe('"a" must contain only punctuation characters')
));

test('Scenario #2', catchMessage(
    fn() => v::punct('c')->assert('b'),
    fn(string $message) => expect($message)->toBe('"b" must contain only punctuation characters and "c"')
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::punct())->assert('.'),
    fn(string $message) => expect($message)->toBe('"." must not contain punctuation characters')
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::punct('d'))->assert('?'),
    fn(string $message) => expect($message)->toBe('"?" must not contain punctuation characters or "d"')
));

test('Scenario #5', catchFullMessage(
    fn() => v::punct()->assert('e'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "e" must contain only punctuation characters')
));

test('Scenario #6', catchFullMessage(
    fn() => v::punct('f')->assert('g'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "g" must contain only punctuation characters and "f"')
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::punct())->assert('!'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "!" must not contain punctuation characters')
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::punct('h'))->assert(';'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- ";" must not contain punctuation characters or "h"')
));
