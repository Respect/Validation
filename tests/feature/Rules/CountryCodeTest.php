<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::countryCode()->assert('1'),
    fn(string $message) => expect($message)->toBe('"1" must be a valid country code')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::countryCode())->assert('BR'),
    fn(string $message) => expect($message)->toBe('"BR" must not be a valid country code')
));

test('Scenario #3', catchFullMessage(
    fn() => v::countryCode()->assert('1'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1" must be a valid country code')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::countryCode())->assert('BR'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "BR" must not be a valid country code')
));
