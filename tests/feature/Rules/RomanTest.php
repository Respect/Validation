<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::roman()->assert(1234),
    '1234 must be a valid Roman numeral',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::roman())->assert('XL'),
    '"XL" must not be a valid Roman numeral',
));

test('Scenario #3', expectFullMessage(
    fn() => v::roman()->assert('e2'),
    '- "e2" must be a valid Roman numeral',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::roman())->assert('IV'),
    '- "IV" must not be a valid Roman numeral',
));
