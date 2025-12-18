<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::equivalent(true)->assert(false),
    fn(string $message) => expect($message)->toBe('`false` must be equivalent to `true`')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::equivalent('Something'))->assert('someThing'),
    fn(string $message) => expect($message)->toBe('"someThing" must not be equivalent to "Something"')
));

test('Scenario #3', catchFullMessage(
    fn() => v::equivalent(123)->assert('true'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "true" must be equivalent to 123')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::equivalent(true))->assert(1),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 1 must not be equivalent to `true`')
));
