<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::directory()->assert('batman'),
    '"batman" must be a directory',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::directory())->assert(dirname('/etc/')),
    '"/" must not be a directory',
));

test('Scenario #3', expectFullMessage(
    fn() => v::directory()->assert('ppz'),
    '- "ppz" must be a directory',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::directory())->assert(dirname('/etc/')),
    '- "/" must not be a directory',
));
