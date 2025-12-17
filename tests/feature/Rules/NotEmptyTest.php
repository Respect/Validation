<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::notEmpty()->assert(null),
    fn(string $message) => expect($message)->toBe('`null` must not be empty'),
));

test('Scenario #2', catchMessage(
    fn() => v::notEmpty()->setName('Field')->assert(null),
    fn(string $message) => expect($message)->toBe('Field must not be empty'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::notEmpty())->assert(1),
    fn(string $message) => expect($message)->toBe('1 must be empty'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::notEmpty()->assert(''),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "" must not be empty'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::notEmpty()->setName('Field')->assert(''),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- Field must not be empty'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::not(v::notEmpty())->assert([1]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[1]` must be empty'),
));
