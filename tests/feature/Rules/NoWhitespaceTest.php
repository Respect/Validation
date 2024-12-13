<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::noWhitespace()->assert('w poiur'),
    '"w poiur" must not contain whitespaces',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::noWhitespace())->assert('wpoiur'),
    '"wpoiur" must contain at least one whitespace',
));

test('Scenario #3', expectFullMessage(
    fn() => v::noWhitespace()->assert('w poiur'),
    '- "w poiur" must not contain whitespaces',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::noWhitespace())->assert('wpoiur'),
    '- "wpoiur" must contain at least one whitespace',
));
