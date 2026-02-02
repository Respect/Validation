<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::space()->assert('ab'),
    fn(string $message) => expect($message)->toBe('"ab" must consist only of space characters'),
));

test('Scenario #2', catchMessage(
    fn() => v::space('c')->assert('cd'),
    fn(string $message) => expect($message)->toBe('"cd" must consist only of space characters or "c"'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::space())->assert("\t"),
    fn(string $message) => expect($message)->toBe('"\\t" must not consist only of space characters'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::space('def'))->assert("\r"),
    fn(string $message) => expect($message)->toBe('"\\r" must not consist only of space characters or "def"'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::space()->assert('ef'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "ef" must consist only of space characters'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::space('e')->assert('gh'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "gh" must consist only of space characters or "e"'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::space())->assert("\n"),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "\\n" must not consist only of space characters'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::space('yk'))->assert(' k'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- " k" must not consist only of space characters or "yk"'),
));
