<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::hexRgbColor()->assert('invalid'),
    '"invalid" must be a hex RGB color',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::hexRgbColor())->assert('#808080'),
    '"#808080" must not be a hex RGB color',
));

test('Scenario #3', expectFullMessage(
    fn() => v::hexRgbColor()->assert('invalid'),
    '- "invalid" must be a hex RGB color',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::hexRgbColor())->assert('#808080'),
    '- "#808080" must not be a hex RGB color',
));
