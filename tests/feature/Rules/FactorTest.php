<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::factor(3)->assert(2),
    '2 must be a factor of 3',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::factor(0))->assert(300),
    '300 must not be a factor of 0',
));

test('Scenario #3', expectFullMessage(
    fn() => v::factor(5)->assert(3),
    '- 3 must be a factor of 5',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::factor(6))->assert(1),
    '- 1 must not be a factor of 6',
));
