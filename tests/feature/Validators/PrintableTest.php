<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::printable()->assert(''),
    fn(string $message) => expect($message)->toBe('"" must consist only of printable characters'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::printable())->assert('abc'),
    fn(string $message) => expect($message)->toBe('"abc" must not consist only of printable characters'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::printable()->assert('foo' . chr(10) . 'bar'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "foo\\nbar" must consist only of printable characters'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::printable())->assert('$%asd'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "$%asd" must not consist only of printable characters'),
));
