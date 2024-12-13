<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::floatType()->assert('42.33'),
    '"42.33" must be float',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::floatType())->assert(INF),
    '`INF` must not be float',
));

test('Scenario #3', expectFullMessage(
    fn() => v::floatType()->assert(true),
    '- `true` must be float',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::floatType())->assert(2.0),
    '- 2.0 must not be float',
));
