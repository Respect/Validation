<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::lessThan(12)->assert(21),
    '21 must be less than 12',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::lessThan('today'))->assert('yesterday'),
    '"yesterday" must not be less than "today"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::lessThan('1988-09-09')->assert('2018-09-09'),
    '- "2018-09-09" must be less than "1988-09-09"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::lessThan('b'))->assert('a'),
    '- "a" must not be less than "b"',
));
