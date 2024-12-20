<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Scenario #1', expectMessageAndError(
    fn() => v::minAge(18)->assert('17 years ago'),
    'The number of years between now and "17 years ago" must be greater than or equal to 18',
    'The minAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead.',
));

test('Scenario #2', expectMessageAndError(
    fn() => v::not(v::minAge(18))->assert('-30 years'),
    'The number of years between now and "-30 years" must be less than 18',
    'The minAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead.',
));

test('Scenario #3', expectMessageAndError(
    fn() => v::minAge(18)->assert('yesterday'),
    'The number of years between now and "yesterday" must be greater than or equal to 18',
    'The minAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead.',
));

test('Scenario #4', expectMessageAndError(
    fn() => v::minAge(18, 'd/m/Y')->assert('12/10/2010'),
    'The number of years between now and "12/10/2010" must be greater than or equal to 18',
    'The minAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead.',
));

test('Scenario #5', expectMessageAndError(
    fn() => v::maxAge(12)->assert('50 years ago'),
    'The number of years between now and "50 years ago" must be less than or equal to 12',
    'The maxAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead.',
));

test('Scenario #6', expectMessageAndError(
    fn() => v::not(v::maxAge(12))->assert('11 years ago'),
    'The number of years between now and "11 years ago" must be greater than 12',
    'The maxAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead.',
));

test('Scenario #7', expectMessageAndError(
    fn() => v::maxAge(12, 'Y-m-d')->assert('1988-09-09'),
    'The number of years between now and "1988-09-09" must be less than or equal to 12',
    'The maxAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead.',
));

test('Scenario #8', expectMessageAndError(
    fn() => v::not(v::maxAge(12, 'Y-m-d'))->assert('2018-01-01'),
    'The number of years between now and "2018-01-01" must be greater than 12',
    'The maxAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead.',
));
