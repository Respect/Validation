<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::boolType()->assert('teste'),
    fn(string $message) => expect($message)->toBe('"teste" must be a boolean'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::boolType())->assert(true),
    fn(string $message) => expect($message)->toBe('`true` must not be a boolean'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::boolType()->assert([]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[]` must be a boolean'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::boolType())->assert(false),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `false` must not be a boolean'),
));
