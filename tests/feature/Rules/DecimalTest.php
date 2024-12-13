<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::decimal(3)->assert(0.1234),
    '0.1234 must have 3 decimals',
));

test('Scenario #2', expectFullMessage(
    fn() => v::decimal(2)->assert(0.123),
    '- 0.123 must have 2 decimals',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::decimal(5))->assert(0.12345),
    '0.12345 must not have 5 decimals',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::decimal(2))->assert(0.34),
    '- 0.34 must not have 2 decimals',
));
