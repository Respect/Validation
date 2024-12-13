<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::number()->assert(acos(1.01)),
    '`NaN` must be a valid number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::number())->assert(42),
    '42 must not be a number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::number()->assert(NAN),
    '- `NaN` must be a valid number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::number())->assert(42),
    '- 42 must not be a number',
));
