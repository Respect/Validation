<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::perfectSquare()->assert(250),
    '250 must be a perfect square number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::perfectSquare())->assert(9),
    '9 must not be a perfect square number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::perfectSquare()->assert(7),
    '- 7 must be a perfect square number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::perfectSquare())->assert(400),
    '- 400 must not be a perfect square number',
));
