<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::filterVar(FILTER_VALIDATE_IP)->assert(42),
    '42 must be valid',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::filterVar(FILTER_VALIDATE_BOOLEAN))->assert('On'),
    '"On" must not be valid',
));

test('Scenario #3', expectFullMessage(
    fn() => v::filterVar(FILTER_VALIDATE_EMAIL)->assert(1.5),
    '- 1.5 must be valid',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::filterVar(FILTER_VALIDATE_FLOAT))->assert(1.0),
    '- 1.0 must not be valid',
));
