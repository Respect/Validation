<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::subset([1, 2])->assert([1, 2, 3]),
    fn(string $message) => expect($message)->toBe('`[1, 2, 3]` must be subset of `[1, 2]`'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::subset([1, 2, 3]))->assert([1, 2]),
    fn(string $message) => expect($message)->toBe('`[1, 2]` must not be subset of `[1, 2, 3]`'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::subset(['A', 'B'])->assert(['B', 'C']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["B", "C"]` must be subset of `["A", "B"]`'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::subset(['A']))->assert(['A']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["A"]` must not be subset of `["A"]`'),
));
