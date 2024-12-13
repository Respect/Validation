<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::boolVal()->assert('ok'),
    '"ok" must be a boolean value',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::boolVal())->assert('yes'),
    '"yes" must not be a boolean value',
));

test('Scenario #3', expectFullMessage(
    fn() => v::boolVal()->assert('yep'),
    '- "yep" must be a boolean value',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::boolVal())->assert('on'),
    '- "on" must not be a boolean value',
));
