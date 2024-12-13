<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::intType()->assert(new stdClass()),
    '`stdClass {}` must be an integer',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::intType())->assert(42),
    '42 must not be an integer',
));

test('Scenario #3', expectFullMessage(
    fn() => v::intType()->assert(INF),
    '- `INF` must be an integer',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::intType())->assert(1234567890),
    '- 1234567890 must not be an integer',
));
