<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::greaterThan(21)->assert(12),
    fn(string $message) => expect($message)->toBe('12 must be greater than 21')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::greaterThan('yesterday'))->assert('today'),
    fn(string $message) => expect($message)->toBe('"today" must not be greater than "yesterday"')
));

test('Scenario #3', catchFullMessage(
    fn() => v::greaterThan('2018-09-09')->assert('1988-09-09'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1988-09-09" must be greater than "2018-09-09"')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::greaterThan('a'))->assert('ba'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "ba" must not be greater than "a"')
));
