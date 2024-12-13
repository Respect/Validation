<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Scenario #1', expectMessage(
    fn() => v::time()->assert('2018-01-30'),
    '"2018-01-30" must be a valid time in the format "23:59:59"',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::time())->assert('09:25:46'),
    '"09:25:46" must not be a valid time in the format "23:59:59"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::time()->assert('2018-01-30'),
    '- "2018-01-30" must be a valid time in the format "23:59:59"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::time('g:i A'))->assert('8:13 AM'),
    '- "8:13 AM" must not be a valid time in the format "11:59 PM"',
));
