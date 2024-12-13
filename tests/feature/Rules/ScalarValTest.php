<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::scalarVal()->assert([]),
    '`[]` must be a scalar value',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::scalarVal())->assert(true),
    '`true` must not be a scalar value',
));

test('Scenario #3', expectFullMessage(
    fn() => v::scalarVal()->assert(new stdClass()),
    '- `stdClass {}` must be a scalar value',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::scalarVal())->assert(42),
    '- 42 must not be a scalar value',
));
