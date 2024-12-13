<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::numericVal()->assert('a'),
    '"a" must be a numeric value',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::numericVal())->assert('1'),
    '"1" must not be a numeric value',
));

test('Scenario #3', expectFullMessage(
    fn() => v::numericVal()->assert('a'),
    '- "a" must be a numeric value',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::numericVal())->assert('1'),
    '- "1" must not be a numeric value',
));
