<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::in([3, 2])->assert(1),
    '1 must be in `[3, 2]`',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::in('foobar'))->assert('foo'),
    '"foo" must not be in "foobar"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::in([2, '1', 3], true)->assert('2'),
    '- "2" must be in `[2, "1", 3]`',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::in([2, '1', 3], true))->assert('1'),
    '- "1" must not be in `[2, "1", 3]`',
));
