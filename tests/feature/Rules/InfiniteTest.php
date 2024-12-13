<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::infinite()->assert(-9),
    '-9 must be an infinite number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::infinite())->assert(INF),
    '`INF` must not be an infinite number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::infinite()->assert(new stdClass()),
    '- `stdClass {}` must be an infinite number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::infinite())->assert(INF * -1),
    '- `-INF` must not be an infinite number',
));
