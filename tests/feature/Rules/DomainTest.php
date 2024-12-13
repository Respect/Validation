<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::domain()->assert('batman'),
    '"batman" must be a valid domain',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::domain())->assert('r--w.com'),
    '"r--w.com" must not be a valid domain',
));

test('Scenario #3', expectFullMessage(
    fn() => v::domain()->assert('p-éz-.kk'),
    '- "p-éz-.kk" must be a valid domain',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::domain())->assert('github.com'),
    '- "github.com" must not be a valid domain',
));
