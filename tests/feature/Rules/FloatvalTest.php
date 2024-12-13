<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::floatVal()->assert('a'),
    '"a" must be a float value',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::floatVal())->assert(165.0),
    '165.0 must not be a float value',
));

test('Scenario #3', expectFullMessage(
    fn() => v::floatVal()->assert('a'),
    '- "a" must be a float value',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::floatVal())->assert('165.7'),
    '- "165.7" must not be a float value',
));
