<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::pis()->assert('this thing'),
    '"this thing" must be a valid PIS number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::pis())->assert('120.6671.406-4'),
    '"120.6671.406-4" must not be a valid PIS number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::pis()->assert('your mother'),
    '- "your mother" must be a valid PIS number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::pis())->assert('120.9378.174-5'),
    '- "120.9378.174-5" must not be a valid PIS number',
));
