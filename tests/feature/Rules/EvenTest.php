<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::even()->assert(-1),
    '-1 must be an even number',
));

test('Scenario #2', expectFullMessage(
    fn() => v::even()->assert(5),
    '- 5 must be an even number',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::even())->assert(6),
    '6 must be an odd number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::even())->assert(8),
    '- 8 must be an odd number',
));
