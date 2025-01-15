<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Min #1', expectMessageAndDeprecation(
    fn() => v::min(INF)->assert(10),
    '10 must be greater than or equal to `INF`',
    'Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead.',
));

test('Min #2', expectMessageAndDeprecation(
    fn() => v::not(v::min(5))->assert(INF),
    '`INF` must be less than 5',
    'Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead.',
));

test('Min #3', expectMessageAndDeprecation(
    fn() => v::min('today')->assert('yesterday'),
    '"yesterday" must be greater than or equal to "today"',
    'Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead.',
));

test('Min #4', expectMessageAndDeprecation(
    fn() => v::not(v::min('a'))->assert('z'),
    '"z" must be less than "a"',
    'Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead.',
));

test('Max #1', expectMessageAndDeprecation(
    fn() => v::max(10)->assert(11),
    '11 must be less than or equal to 10',
    'Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead.',
));

test('Max #2', expectMessageAndDeprecation(
    fn() => v::not(v::max(10))->assert(5),
    '5 must be greater than 10',
    'Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead.',
));

test('Max #3', expectMessageAndDeprecation(
    fn() => v::max('today')->assert('tomorrow'),
    '"tomorrow" must be less than or equal to "today"',
    'Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead.',
));

test('Max #4', expectMessageAndDeprecation(
    fn() => v::not(v::max('b'))->assert('a'),
    '"a" must be greater than "b"',
    'Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead.',
));
