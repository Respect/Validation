<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::fibonacci()->assert(4),
    '4 must be a valid Fibonacci number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::fibonacci())->assert(5),
    '5 must not be a valid Fibonacci number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::fibonacci()->assert(16),
    '- 16 must be a valid Fibonacci number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::fibonacci())->assert(21),
    '- 21 must not be a valid Fibonacci number',
));
