<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

use Respect\StringFormatter\FormatterBuilder as f;

test('Scenario #1: Validates that a string is already in a specific format (e.g. checking formats on existing data)', catchMessage(
    fn() => v::format(f::pattern('00-00'))->assert('42.33'),
    fn(string $message) => expect($message)->toBe('"42.33" must be formatted as "42-33"'),
));

test('Scenario #2: Validates if some mask was previously applied (e.g. checking the results of a masking tool)', catchMessage(
    fn() => v::format(f::mask('1-@'))->assert('alganet@gmail.com'),
    fn(string $message) => expect($message)->toBe('"alganet@gmail.com" must be formatted as "*******@gmail.com"'),
));

test('Scenario #3: Validates that a string is not in a specific format (e.g. banning a specific problematic format)', catchMessage(
    fn() => v::not(v::format(f::pattern('00-00')))->assert('42-33'),
    fn(string $message) => expect($message)->toBe('"42-33" must not be formatted as "42-33"'),
));

test('Scenario #4: Validates if some mask was not previously applied (e.g. checking if a mask should not have been applied)', catchMessage(
    fn() => v::not(v::format(f::mask('1-@')))->assert('*******@gmail.com'),
    fn(string $message) => expect($message)->toBe('"*******@gmail.com" must not be formatted as "*******@gmail.com"'),
));

test('Scenario #5: Named messages', catchMessage(
    fn() => v::named('Vanity plate', v::format(f::pattern('AAA-0000')))->assert('DAD8008'),
    fn(string $message) => expect($message)->toBe('Vanity plate must be formatted as "DAD-8008"'),
));

test('Scenario #6: Named messages, negated', catchMessage(
    fn() => v::named('Vanity plate', v::not(v::format(f::pattern('AAA 0000'))))->assert('DAD 8008'),
    fn(string $message) => expect($message)->toBe('Vanity plate must not be formatted as "DAD 8008"'),
));
