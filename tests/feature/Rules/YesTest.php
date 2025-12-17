<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::not(v::yes())->assert('Yes'),
    fn(string $message) => expect($message)->toBe('"Yes" must not be similar to "Yes"'),
));

test('Scenario #2', catchMessage(
    fn() => v::yes()->assert('si'),
    fn(string $message) => expect($message)->toBe('"si" must be similar to "Yes"'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::not(v::yes())->assert('Yes'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "Yes" must not be similar to "Yes"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::yes()->assert('si'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "si" must be similar to "Yes"'),
));
