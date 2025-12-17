<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::noWhitespace()->assert('w poiur'),
    fn(string $message) => expect($message)->toBe('"w poiur" must not contain whitespaces'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::noWhitespace())->assert('wpoiur'),
    fn(string $message) => expect($message)->toBe('"wpoiur" must contain at least one whitespace'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::noWhitespace()->assert('w poiur'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "w poiur" must not contain whitespaces'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::noWhitespace())->assert('wpoiur'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "wpoiur" must contain at least one whitespace'),
));
