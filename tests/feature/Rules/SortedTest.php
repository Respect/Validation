<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::sorted('ASC')->assert([1, 3, 2]),
    fn(string $message) => expect($message)->toBe('`[1, 3, 2]` must be sorted in ascending order'),
));

test('Scenario #2', catchMessage(
    fn() => v::sorted('DESC')->assert([1, 2, 3]),
    fn(string $message) => expect($message)->toBe('`[1, 2, 3]` must be sorted in descending order'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::sorted('ASC'))->assert([1, 2, 3]),
    fn(string $message) => expect($message)->toBe('`[1, 2, 3]` must not be sorted in ascending order'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::sorted('DESC'))->assert([3, 2, 1]),
    fn(string $message) => expect($message)->toBe('`[3, 2, 1]` must not be sorted in descending order'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::sorted('ASC')->assert([3, 2, 1]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[3, 2, 1]` must be sorted in ascending order'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::sorted('DESC')->assert([1, 2, 3]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[1, 2, 3]` must be sorted in descending order'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::sorted('ASC'))->assert([1, 2, 3]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[1, 2, 3]` must not be sorted in ascending order'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::sorted('DESC'))->assert([3, 2, 1]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[3, 2, 1]` must not be sorted in descending order'),
));
