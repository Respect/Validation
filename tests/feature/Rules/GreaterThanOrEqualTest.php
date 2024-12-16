<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::greaterThanOrEqual(INF)->assert(10),
    '10 must be greater than or equal to `INF`',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::greaterThanOrEqual(5))->assert(INF),
    '`INF` must be less than 5',
));

test('Scenario #3', expectFullMessage(
    fn() => v::greaterThanOrEqual('today')->assert('yesterday'),
    '- "yesterday" must be greater than or equal to "today"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::greaterThanOrEqual('a'))->assert('z'),
    '- "z" must be less than "a"',
));
