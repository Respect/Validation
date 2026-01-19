<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::space()->assert('ab'),
    fn(string $message) => expect($message)->toBe('"ab" must contain only space characters'),
));

test('Scenario #2', catchMessage(
    fn() => v::space('c')->assert('cd'),
    fn(string $message) => expect($message)->toBe('"cd" must contain only space characters and "c"'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::space())->assert("\t"),
    fn(string $message) => expect($message)->toBe('"\\t" must not contain space characters'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::space('def'))->assert("\r"),
    fn(string $message) => expect($message)->toBe('"\\r" must not contain space characters or "def"'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::space()->assert('ef'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "ef" must contain only space characters'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::space('e')->assert('gh'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "gh" must contain only space characters and "e"'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::space())->assert("\n"),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "\\n" must not contain space characters'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::space('yk'))->assert(' k'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- " k" must not contain space characters or "yk"'),
));
