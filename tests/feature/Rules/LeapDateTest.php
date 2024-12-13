<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::leapDate('Y-m-d')->assert('1989-02-29'),
    '"1989-02-29" must be a valid leap date',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::leapDate('Y-m-d'))->assert('1988-02-29'),
    '"1988-02-29" must not be a leap date',
));

test('Scenario #3', expectFullMessage(
    fn() => v::leapDate('Y-m-d')->assert('1990-02-29'),
    '- "1990-02-29" must be a valid leap date',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::leapDate('Y-m-d'))->assert('1992-02-29'),
    '- "1992-02-29" must not be a leap date',
));
