<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::odd()->assert(2),
    '2 must be an odd number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::odd())->assert(7),
    '7 must be an even number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::odd()->assert(2),
    '- 2 must be an odd number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::odd())->assert(9),
    '- 9 must be an even number',
));
