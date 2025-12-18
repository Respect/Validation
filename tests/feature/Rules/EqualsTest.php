<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::equals(123)->assert(321),
    fn(string $message) => expect($message)->toBe('321 must be equal to 123')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::equals(321))->assert(321),
    fn(string $message) => expect($message)->toBe('321 must not be equal to 321')
));

test('Scenario #3', catchFullMessage(
    fn() => v::equals(123)->assert(321),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 321 must be equal to 123')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::equals(321))->assert(321),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 321 must not be equal to 321')
));
