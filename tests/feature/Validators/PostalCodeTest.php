<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::postalCode('BR')->assert('1057BV'),
    fn(string $message) => expect($message)->toBe('"1057BV" must be a postal code for "BR"'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::postalCode('NL'))->assert('1057BV'),
    fn(string $message) => expect($message)->toBe('"1057BV" must not be a postal code for "NL"'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::postalCode('BR')->assert('1057BV'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1057BV" must be a postal code for "BR"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::postalCode('NL'))->assert('1057BV'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1057BV" must not be a postal code for "NL"'),
));
