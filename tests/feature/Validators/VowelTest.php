<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::vowel()->assert('b'),
    fn(string $message) => expect($message)->toBe('"b" must consist of vowels only'),
));

test('Scenario #2', catchMessage(
    fn() => v::vowel('c')->assert('d'),
    fn(string $message) => expect($message)->toBe('"d" must consist of vowels or "c"'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::vowel())->assert('a'),
    fn(string $message) => expect($message)->toBe('"a" must not consist of vowels only'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::vowel('f'))->assert('e'),
    fn(string $message) => expect($message)->toBe('"e" must not consist of vowels or "f"'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::vowel()->assert('g'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "g" must consist of vowels only'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::vowel('h')->assert('j'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "j" must consist of vowels or "h"'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::vowel())->assert('i'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "i" must not consist of vowels only'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::vowel('k'))->assert('o'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "o" must not consist of vowels or "k"'),
));
