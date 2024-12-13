<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::positive()->assert(-10),
    '-10 must be a positive number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::positive())->assert(16),
    '16 must not be a positive number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::positive()->assert('a'),
    '- "a" must be a positive number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::positive())->assert('165'),
    '- "165" must not be a positive number',
));
