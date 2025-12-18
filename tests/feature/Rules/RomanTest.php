<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::roman()->assert(1234),
    fn(string $message) => expect($message)->toBe('1234 must be a valid Roman numeral')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::roman())->assert('XL'),
    fn(string $message) => expect($message)->toBe('"XL" must not be a valid Roman numeral')
));

test('Scenario #3', catchFullMessage(
    fn() => v::roman()->assert('e2'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "e2" must be a valid Roman numeral')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::roman())->assert('IV'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "IV" must not be a valid Roman numeral')
));
