<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::between(1, 2)->assert(0),
    '0 must be between 1 and 2',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::between('yesterday', 'tomorrow'))->assert('today'),
    '"today" must not be between "yesterday" and "tomorrow"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::between('a', 'c')->assert('d'),
    '- "d" must be between "a" and "c"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::between(-INF, INF))->assert(0),
    '- 0 must not be between `-INF` and `INF`',
));

test('Scenario #5', expectFullMessage(
    fn() => v::not(v::between('a', 'b'))->assert('a'),
    '- "a" must not be between "a" and "b"',
));

test('Scenario #6', expectFullMessage(
    fn() => v::not(v::between(1, 42))->assert(41),
    '- 41 must not be between 1 and 42',
));
