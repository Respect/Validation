<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::alpha()->assert('aaa%a'),
    fn(string $message) => expect($message)->toBe('"aaa%a" must consist only of letters (a-z)'),
));

test('Scenario #2', catchMessage(
    fn() => v::alpha(' ')->assert('bbb%b'),
    fn(string $message) => expect($message)->toBe('"bbb%b" must consist only of letters (a-z) or " "'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::alpha())->assert('ccccc'),
    fn(string $message) => expect($message)->toBe('"ccccc" must not consist only of letters (a-z)'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::alpha('% '))->assert('ddd%d'),
    fn(string $message) => expect($message)->toBe('"ddd%d" must not consist only of letters (a-z) or "% "'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::alpha()->assert('eee^e'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "eee^e" must consist only of letters (a-z)'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::not(v::alpha())->assert('fffff'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "fffff" must not consist only of letters (a-z)'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::alpha('* &%')->assert('ggg^g'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "ggg^g" must consist only of letters (a-z) or "* &%"'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::alpha('^'))->assert('hhh^h'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "hhh^h" must not consist only of letters (a-z) or "^"'),
));
