<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::postalCode('BR')->assert('1057BV'),
    fn(string $message) => expect($message)->toBe('"1057BV" must be a valid postal code on "BR"'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::postalCode('NL'))->assert('1057BV'),
    fn(string $message) => expect($message)->toBe('"1057BV" must not be a valid postal code on "NL"'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::postalCode('BR')->assert('1057BV'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1057BV" must be a valid postal code on "BR"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::postalCode('NL'))->assert('1057BV'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1057BV" must not be a valid postal code on "NL"'),
));
