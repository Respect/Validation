<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::version()->assert('1.3.7--'),
    '"1.3.7--" must be a version',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::version())->assert('1.0.0-alpha'),
    '"1.0.0-alpha" must not be a version',
));

test('Scenario #3', expectFullMessage(
    fn() => v::version()->assert('1.2.3.4-beta'),
    '- "1.2.3.4-beta" must be a version',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::version())->assert('1.3.7-rc.1'),
    '- "1.3.7-rc.1" must not be a version',
));
