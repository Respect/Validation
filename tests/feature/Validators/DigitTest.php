<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::digit()->assert('abc'),
    fn(string $message) => expect($message)->toBe('"abc" must consist only of digits (0-9)'),
));

test('Scenario #2', catchMessage(
    fn() => v::digit('-')->assert('a-b'),
    fn(string $message) => expect($message)->toBe('"a-b" must consist only of digits (0-9) or "-"'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::digit())->assert('123'),
    fn(string $message) => expect($message)->toBe('"123" must not consist only of digits (0-9)'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::digit('-'))->assert('1-3'),
    fn(string $message) => expect($message)->toBe('"1-3" must not consist only of digits (0-9) or "-"'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::digit()->assert('abc'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "abc" must consist only of digits (0-9)'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::digit('-')->assert('a-b'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a-b" must consist only of digits (0-9) or "-"'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::digit())->assert('123'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "123" must not consist only of digits (0-9)'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::digit('-'))->assert('1-3'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1-3" must not consist only of digits (0-9) or "-"'),
));
