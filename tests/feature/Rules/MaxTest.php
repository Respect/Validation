<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Non-iterable', expectAll(
    fn() => v::max(v::negative())->assert(null),
    '`null` must be iterable',
    '- `null` must be iterable',
    ['max' => '`null` must be iterable']
));

test('Empty', expectAll(
    fn() => v::max(v::negative())->assert([]),
    'The value must not be empty',
    '- The value must not be empty',
    ['max' => 'The value must not be empty']
));

test('Default', expectAll(
    fn() => v::max(v::negative())->assert([1, 2, 3]),
    'As the maximum of `[1, 2, 3]`, 3 must be a negative number',
    '- As the maximum of `[1, 2, 3]`, 3 must be a negative number',
    ['maxNegative' => 'As the maximum of `[1, 2, 3]`, 3 must be a negative number']
));

test('Inverted', expectAll(
    fn() => v::not(v::max(v::negative()))->assert([-3, -2, -1]),
    'As the maximum of `[-3, -2, -1]`, -1 must not be a negative number',
    '- As the maximum of `[-3, -2, -1]`, -1 must not be a negative number',
    ['notMaxNegative' => 'As the maximum of `[-3, -2, -1]`, -1 must not be a negative number']
));

test('With wrapped name, default', expectAll(
    fn() => v::max(v::negative()->setName('Wrapped'))->setName('Wrapper')->assert([1, 2, 3]),
    'The maximum of Wrapped must be a negative number',
    '- The maximum of Wrapped must be a negative number',
    ['maxNegative' => 'The maximum of Wrapped must be a negative number']
));

test('With wrapper name, default', expectAll(
    fn() => v::max(v::negative())->setName('Wrapper')->assert([1, 2, 3]),
    'The maximum of Wrapper must be a negative number',
    '- The maximum of Wrapper must be a negative number',
    ['maxNegative' => 'The maximum of Wrapper must be a negative number']
));

test('With wrapped name, inverted', expectAll(
    fn() => v::not(v::max(v::negative()->setName('Wrapped')))->setName('Wrapper')->assert([-3, -2, -1]),
    'The maximum of Wrapped must not be a negative number',
    '- The maximum of Wrapped must not be a negative number',
    ['notMaxNegative' => 'The maximum of Wrapped must not be a negative number']
));

test('With wrapper name, inverted', expectAll(
    fn() => v::not(v::max(v::negative()))->setName('Wrapper')->assert([-3, -2, -1]),
    'The maximum of Wrapper must not be a negative number',
    '- The maximum of Wrapper must not be a negative number',
    ['notMaxNegative' => 'The maximum of Wrapper must not be a negative number']
));

test('With template, default', expectAll(
    fn() => v::max(v::negative())->assert([1, 2, 3], 'The maximum of the value is not what we expect'),
    'The maximum of the value is not what we expect',
    '- The maximum of the value is not what we expect',
    ['maxNegative' => 'The maximum of the value is not what we expect']
));
