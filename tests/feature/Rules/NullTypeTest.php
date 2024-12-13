<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::nullType()->assert(''),
    '"" must be null',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::nullType())->assert(null),
    '`null` must not be null',
));

test('Scenario #3', expectFullMessage(
    fn() => v::nullType()->assert(false),
    '- `false` must be null',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::nullType())->assert(null),
    '- `null` must not be null',
));
