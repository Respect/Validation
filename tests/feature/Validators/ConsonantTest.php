<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::consonant()->assert('aeiou'),
    fn(string $message) => expect($message)->toBe('"aeiou" must only contain consonants'),
));

test('Scenario #2', catchMessage(
    fn() => v::consonant('d')->assert('daeiou'),
    fn(string $message) => expect($message)->toBe('"daeiou" must only contain consonants and "d"'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::consonant())->assert('bcd'),
    fn(string $message) => expect($message)->toBe('"bcd" must not contain consonants'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::consonant('a'))->assert('abcd'),
    fn(string $message) => expect($message)->toBe('"abcd" must not contain consonants or "a"'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::consonant()->assert('aeiou'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "aeiou" must only contain consonants'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::consonant('d')->assert('daeiou'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "daeiou" must only contain consonants and "d"'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::consonant())->assert('bcd'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "bcd" must not contain consonants'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::consonant('a'))->assert('abcd'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "abcd" must not contain consonants or "a"'),
));
