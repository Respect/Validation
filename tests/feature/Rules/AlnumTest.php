<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::alnum()->assert('abc%1'),
    fn(string $message) => expect($message)->toBe('"abc%1" must contain only letters (a-z) and digits (0-9)'),
));

test('Scenario #2', catchMessage(
    fn() => v::alnum(' ')->assert('abc%2'),
    fn(string $message) => expect($message)->toBe('"abc%2" must contain only letters (a-z), digits (0-9), and " "'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::alnum())->assert('abcd3'),
    fn(string $message) => expect($message)->toBe('"abcd3" must not contain letters (a-z) or digits (0-9)'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::alnum('% '))->assert('abc%4'),
    fn(string $message) => expect($message)->toBe('"abc%4" must not contain letters (a-z), digits (0-9), or "% "'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::alnum()->assert('abc^1'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "abc^1" must contain only letters (a-z) and digits (0-9)'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::not(v::alnum())->assert('abcd2'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "abcd2" must not contain letters (a-z) or digits (0-9)'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::alnum('* &%')->assert('abc^3'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "abc^3" must contain only letters (a-z), digits (0-9), and "* &%"'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::alnum('^'))->assert('abc^4'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "abc^4" must not contain letters (a-z), digits (0-9), or "^"'),
));
