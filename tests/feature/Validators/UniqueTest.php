<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::unique()->assert([1, 2, 2, 3]),
    fn(string $message) => expect($message)->toBe('`[1, 2, 2, 3]` must not contain duplicates'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::unique())->assert([1, 2, 3, 4]),
    fn(string $message) => expect($message)->toBe('`[1, 2, 3, 4]` must contain duplicates'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::unique()->assert('test'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "test" must not contain duplicates'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::unique())->assert(['a', 'b', 'c']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["a", "b", "c"]` must contain duplicates'),
));
