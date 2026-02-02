<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::intVal()->assert('42.33'),
    fn(string $message) => expect($message)->toBe('"42.33" must be an integer'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::intVal())->assert(2),
    fn(string $message) => expect($message)->toBe('2 must not be an integer'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::intVal()->assert('Foo'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "Foo" must be an integer'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::intVal())->assert(3),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 3 must not be an integer'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::not(v::intVal())->assert(-42),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- -42 must not be an integer'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::not(v::intVal())->assert('-42'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "-42" must not be an integer'),
));
