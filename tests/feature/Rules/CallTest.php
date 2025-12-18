<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::call('trim', v::noWhitespace())->assert(' two words '),
    fn(string $message) => expect($message)->toBe('"two words" must not contain whitespaces')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::call('stripslashes', v::stringType()))->assert(' some\thing '),
    fn(string $message) => expect($message)->toBe('" something " must not be a string')
));

test('Scenario #3', catchMessage(
    fn() => v::call('stripslashes', v::alwaysValid())->assert([]),
    fn(string $message) => expect($message)->toBe('`[]` must be a suitable argument for "stripslashes"')
));

test('Scenario #4', catchFullMessage(
    fn() => v::call('strval', v::intType())->assert(1234),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1234" must be an integer')
));

test('Scenario #5', catchFullMessage(
    fn() => v::not(v::call('is_float', v::boolType()))->assert(1.2),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `true` must not be a boolean')
));

test('Scenario #6', catchFullMessage(
    fn() => v::call('array_shift', v::alwaysValid())->assert(INF),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `INF` must be a suitable argument for "array_shift"')
));
