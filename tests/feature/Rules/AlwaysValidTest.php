<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::not(v::alwaysValid())->assert(true),
    '`true` must be invalid',
));

test('Scenario #2', expectFullMessage(
    fn() => v::not(v::alwaysValid())->assert(true),
    '- `true` must be invalid',
));
