<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::floatType()->assert('42.33'),
    fn(string $message) => expect($message)->toBe('"42.33" must be a float'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::floatType())->assert(INF),
    fn(string $message) => expect($message)->toBe('`INF` must not be a float'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::floatType()->assert(true),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `true` must be a float'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::floatType())->assert(2.0),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 2.0 must not be a float'),
));
