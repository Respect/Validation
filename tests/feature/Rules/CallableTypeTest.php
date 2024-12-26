<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::callableType()->assert([]),
    '`[]` must be a callable',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::callableType())->assert('trim'),
    '"trim" must not be a callable',
));

test('Scenario #3', expectFullMessage(
    fn() => v::callableType()->assert(true),
    '- `true` must be a callable',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::callableType())->assert(function (): void {
        // Do nothing
    }),
    '- `Closure {}` must not be a callable',
));
