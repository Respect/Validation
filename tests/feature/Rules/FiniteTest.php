<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::finite()->assert(''),
    '"" must be a finite number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::finite())->assert(10),
    '10 must not be a finite number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::finite()->assert([12]),
    '- `[12]` must be a finite number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::finite())->assert('123456'),
    '- "123456" must not be a finite number',
));
