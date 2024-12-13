<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::cnh()->assert('batman'),
    '"batman" must be a valid CNH number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::cnh())->assert('02650306461'),
    '"02650306461" must not be a valid CNH number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::cnh()->assert('bruce wayne'),
    '- "bruce wayne" must be a valid CNH number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::cnh())->assert('02650306461'),
    '- "02650306461" must not be a valid CNH number',
));
