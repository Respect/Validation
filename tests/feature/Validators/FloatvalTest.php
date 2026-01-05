<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::floatVal()->assert('a'),
    fn(string $message) => expect($message)->toBe('"a" must be a float value'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::floatVal())->assert(165.0),
    fn(string $message) => expect($message)->toBe('165.0 must not be a float value'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::floatVal()->assert('a'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a" must be a float value'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::floatVal())->assert('165.7'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "165.7" must not be a float value'),
));
