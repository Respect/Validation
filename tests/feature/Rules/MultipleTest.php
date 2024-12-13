<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::multiple(3)->assert(22),
    '22 must be a multiple of 3',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::multiple(3))->assert(9),
    '9 must not be a multiple of 3',
));

test('Scenario #3', expectFullMessage(
    fn() => v::multiple(2)->assert(5),
    '- 5 must be a multiple of 2',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::multiple(5))->assert(25),
    '- 25 must not be a multiple of 5',
));
