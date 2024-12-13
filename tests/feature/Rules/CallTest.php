<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::call('trim', v::noWhitespace())->assert(' two words '),
    '"two words" must not contain whitespaces',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::call('stripslashes', v::stringType()))->assert(' some\thing '),
    '" something " must not be a string',
));

test('Scenario #3', expectMessage(
    fn() => v::call('stripslashes', v::alwaysValid())->assert([]),
    '`[]` must be a suitable argument for `stripslashes(string $string): string`',
));

test('Scenario #4', expectFullMessage(
    fn() => v::call('strval', v::intType())->assert(1234),
    '- "1234" must be an integer',
));

test('Scenario #5', expectFullMessage(
    fn() => v::not(v::call('is_float', v::boolType()))->assert(1.2),
    '- `true` must not be a boolean',
));

test('Scenario #6', expectFullMessage(
    fn() => v::call('array_shift', v::alwaysValid())->assert(INF),
    '- `INF` must be a suitable argument for `array_shift(array &$array): ?mixed`',
));
