<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Scenario #1', expectMessage(
    fn() => v::dateTime()->assert('FooBarBazz'),
    '"FooBarBazz" must be a valid date/time',
));

test('Scenario #2', expectMessage(
    fn() => v::dateTime('c')->assert('06-12-1995'),
    '"06-12-1995" must be a valid date/time in the format "2005-12-30T01:02:03+00:00"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::dateTime()->assert('QuxQuuxx'),
    '- "QuxQuuxx" must be a valid date/time',
));

test('Scenario #4', expectFullMessage(
    fn() => v::dateTime('r')->assert(2018013030),
    '- 2018013030 must be a valid date/time in the format "Fri, 30 Dec 2005 01:02:03 +0000"',
));

test('Scenario #5', expectMessage(
    fn() => v::not(v::dateTime())->assert('4 days ago'),
    '"4 days ago" must not be a valid date/time',
));

test('Scenario #6', expectMessage(
    fn() => v::not(v::dateTime('Y-m-d'))->assert('1988-09-09'),
    '"1988-09-09" must not be a valid date/time in the format "2005-12-30"',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::dateTime())->assert('+3 weeks'),
    '- "+3 weeks" must not be a valid date/time',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::dateTime('d/m/y'))->assert('23/07/99'),
    '- "23/07/99" must not be a valid date/time in the format "30/12/05"',
));
