<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::regex('/^w+$/')->assert('w poiur'),
    '"w poiur" must match the pattern `/^w+$/`',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::regex('/^[a-z]+$/'))->assert('wpoiur'),
    '"wpoiur" must not match the pattern `/^[a-z]+$/`',
));

test('Scenario #3', expectFullMessage(
    fn() => v::regex('/^w+$/')->assert(new stdClass()),
    '- `stdClass {}` must match the pattern `/^w+$/`',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::regex('/^[a-z]+$/i'))->assert('wPoiur'),
    '- "wPoiur" must not match the pattern `/^[a-z]+$/i`',
));
