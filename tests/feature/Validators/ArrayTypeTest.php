<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::arrayType()->assert('teste'),
    fn(string $message) => expect($message)->toBe('"teste" must be an array'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::arrayType())->assert([]),
    fn(string $message) => expect($message)->toBe('`[]` must not be an array'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::arrayType()->assert(new ArrayObject()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `ArrayObject { getArrayCopy() => [] }` must be an array'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::arrayType())->assert([1, 2, 3]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[1, 2, 3]` must not be an array'),
));
