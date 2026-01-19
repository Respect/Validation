<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::executable()->assert('bar'),
    fn(string $message) => expect($message)->toBe('"bar" must be an executable file'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::executable())->assert('tests/fixtures/executable'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/executable" must not be an executable file'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::executable()->assert('bar'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "bar" must be an executable file'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::executable())->assert('tests/fixtures/executable'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/executable" must not be an executable file'),
));
