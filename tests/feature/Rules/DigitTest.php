<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::digit()->assert('abc'),
    fn(string $message) => expect($message)->toBe('"abc" must contain only digits (0-9)')
));

test('Scenario #2', catchMessage(
    fn() => v::digit('-')->assert('a-b'),
    fn(string $message) => expect($message)->toBe('"a-b" must contain only digits (0-9) and "-"')
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::digit())->assert('123'),
    fn(string $message) => expect($message)->toBe('"123" must not contain digits (0-9)')
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::digit('-'))->assert('1-3'),
    fn(string $message) => expect($message)->toBe('"1-3" must not contain digits (0-9) and "-"')
));

test('Scenario #5', catchFullMessage(
    fn() => v::digit()->assert('abc'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "abc" must contain only digits (0-9)')
));

test('Scenario #6', catchFullMessage(
    fn() => v::digit('-')->assert('a-b'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a-b" must contain only digits (0-9) and "-"')
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::digit())->assert('123'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "123" must not contain digits (0-9)')
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::digit('-'))->assert('1-3'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1-3" must not contain digits (0-9) and "-"')
));
