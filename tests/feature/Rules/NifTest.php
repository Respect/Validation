<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::nif()->assert('06357771Q'),
    '"06357771Q" must be a valid NIF',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::nif())->assert('71110316C'),
    '"71110316C" must not be a valid NIF',
));

test('Scenario #3', expectFullMessage(
    fn() => v::nif()->assert('06357771Q'),
    '- "06357771Q" must be a valid NIF',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::nif())->assert('R1332622H'),
    '- "R1332622H" must not be a valid NIF',
));
