<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::printable()->assert(''),
    fn(string $message) => expect($message)->toBe('"" must contain only printable characters'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::printable())->assert('abc'),
    fn(string $message) => expect($message)->toBe('"abc" must not contain printable characters'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::printable()->assert('foo' . chr(10) . 'bar'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "foo\\nbar" must contain only printable characters'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::printable())->assert('$%asd'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "$%asd" must not contain printable characters'),
));
