<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Scenario #1', expectMessage(
    fn() => v::date()->assert('2018-01-29T08:32:54+00:00'),
    '"2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::date())->assert('2018-01-29'),
    '"2018-01-29" must not be a valid date in the format "2005-12-30"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::date()->assert('2018-01-29T08:32:54+00:00'),
    '- "2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::date('d/m/Y'))->assert('29/01/2018'),
    '- "29/01/2018" must not be a valid date in the format "30/12/2005"',
));
