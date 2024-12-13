<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::phpLabel()->assert('f o o'),
    '"f o o" must be a valid PHP label',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::phpLabel())->assert('correctOne'),
    '"correctOne" must not be a valid PHP label',
));

test('Scenario #3', expectFullMessage(
    fn() => v::phpLabel()->assert('0wner'),
    '- "0wner" must be a valid PHP label',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::phpLabel())->assert('Respect'),
    '- "Respect" must not be a valid PHP label',
));
