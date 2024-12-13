<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::iterableVal()->assert(3),
    '3 must be an iterable value',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::iterableVal())->assert([2, 3]),
    '`[2, 3]` must not be an iterable value',
));

test('Scenario #3', expectFullMessage(
    fn() => v::iterableVal()->assert('String'),
    '- "String" must be an iterable value',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::iterableVal())->assert(new stdClass()),
    '- `stdClass {}` must not be an iterable value',
));
