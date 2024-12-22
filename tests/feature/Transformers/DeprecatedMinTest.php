<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessageAndError(
    fn() => v::min(INF)->assert(10),
    '10 must be greater than or equal to `INF`',
    'Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead.',
));

test('Scenario #2', expectMessageAndError(
    fn() => v::not(v::min(5))->assert(INF),
    '`INF` must be less than 5',
    'Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead.',
));

test('Scenario #3', expectMessageAndError(
    fn() => v::min('today')->assert('yesterday'),
    '"yesterday" must be greater than or equal to "today"',
    'Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead.',
));

test('Scenario #4', expectMessageAndError(
    fn() => v::not(v::min('a'))->assert('z'),
    '"z" must be less than "a"',
    'Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead.',
));
