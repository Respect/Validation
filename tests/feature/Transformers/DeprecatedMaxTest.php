<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessageAndDeprecation(
    fn() => v::max(10)->assert(11),
    '11 must be less than or equal to 10',
    'Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead.',
));

test('Scenario #2', expectMessageAndDeprecation(
    fn() => v::not(v::max(10))->assert(5),
    '5 must be greater than 10',
    'Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead.',
));

test('Scenario #3', expectMessageAndDeprecation(
    fn() => v::max('today')->assert('tomorrow'),
    '"tomorrow" must be less than or equal to "today"',
    'Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead.',
));

test('Scenario #4', expectMessageAndDeprecation(
    fn() => v::not(v::max('b'))->assert('a'),
    '"a" must be greater than "b"',
    'Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead.',
));
