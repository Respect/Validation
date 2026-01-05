<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::phpLabel()->assert('f o o'),
    fn(string $message) => expect($message)->toBe('"f o o" must be a valid PHP label'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::phpLabel())->assert('correctOne'),
    fn(string $message) => expect($message)->toBe('"correctOne" must not be a valid PHP label'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::phpLabel()->assert('0wner'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "0wner" must be a valid PHP label'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::phpLabel())->assert('Respect'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "Respect" must not be a valid PHP label'),
));
