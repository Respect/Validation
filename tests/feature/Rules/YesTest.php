<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::not(v::yes())->assert('Yes'),
    '"Yes" must not be similar to "Yes"',
));

test('Scenario #2', expectMessage(
    fn() => v::yes()->assert('si'),
    '"si" must be similar to "Yes"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::not(v::yes())->assert('Yes'),
    '- "Yes" must not be similar to "Yes"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::yes()->assert('si'),
    '- "si" must be similar to "Yes"',
));
