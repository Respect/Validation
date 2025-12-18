<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::filterVar(FILTER_VALIDATE_IP)->assert(42),
    fn(string $message) => expect($message)->toBe('42 must be valid')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::filterVar(FILTER_VALIDATE_BOOLEAN))->assert('On'),
    fn(string $message) => expect($message)->toBe('"On" must not be valid')
));

test('Scenario #3', catchFullMessage(
    fn() => v::filterVar(FILTER_VALIDATE_EMAIL)->assert(1.5),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 1.5 must be valid')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::filterVar(FILTER_VALIDATE_FLOAT))->assert(1.0),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 1.0 must not be valid')
));
