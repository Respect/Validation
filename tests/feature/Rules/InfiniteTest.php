<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::infinite()->assert(-9),
    fn(string $message) => expect($message)->toBe('-9 must be an infinite number')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::infinite())->assert(INF),
    fn(string $message) => expect($message)->toBe('`INF` must not be an infinite number')
));

test('Scenario #3', catchFullMessage(
    fn() => v::infinite()->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must be an infinite number')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::infinite())->assert(INF * -1),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `-INF` must not be an infinite number')
));
