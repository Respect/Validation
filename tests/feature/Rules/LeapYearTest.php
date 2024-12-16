<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::leapYear()->assert('2009'),
    '"2009" must be a valid leap year',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::leapYear())->assert('2008'),
    '"2008" must not be a leap year',
));

test('Scenario #3', expectFullMessage(
    fn() => v::leapYear()->assert('2009-02-29'),
    '- "2009-02-29" must be a valid leap year',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::leapYear())->assert('2008'),
    '- "2008" must not be a leap year',
));
