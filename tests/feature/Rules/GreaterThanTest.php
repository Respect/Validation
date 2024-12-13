<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::greaterThan(21)->assert(12),
    '12 must be greater than 21',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::greaterThan('yesterday'))->assert('today'),
    '"today" must not be greater than "yesterday"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::greaterThan('2018-09-09')->assert('1988-09-09'),
    '- "1988-09-09" must be greater than "2018-09-09"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::greaterThan('a'))->assert('ba'),
    '- "ba" must not be greater than "a"',
));
