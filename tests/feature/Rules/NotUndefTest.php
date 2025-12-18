<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::notUndef()->assert(null),
    fn(string $message) => expect($message)->toBe('`null` must be defined')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::notUndef())->assert(0),
    fn(string $message) => expect($message)->toBe('0 must be undefined')
));

test('Scenario #3', catchMessage(
    fn() => v::notUndef()->setName('Field')->assert(null),
    fn(string $message) => expect($message)->toBe('Field must be defined')
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::notUndef()->setName('Field'))->assert([]),
    fn(string $message) => expect($message)->toBe('Field must be undefined')
));

test('Scenario #5', catchFullMessage(
    fn() => v::notUndef()->assert(''),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "" must be defined')
));

test('Scenario #6', catchFullMessage(
    fn() => v::not(v::notUndef())->assert([]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[]` must be undefined')
));

test('Scenario #7', catchFullMessage(
    fn() => v::notUndef()->setName('Field')->assert(''),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- Field must be defined')
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::notUndef()->setName('Field'))->assert([]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- Field must be undefined')
));
