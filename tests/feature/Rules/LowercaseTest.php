<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::lowercase()->assert('UPPERCASE'),
    '"UPPERCASE" must contain only lowercase letters',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::lowercase())->assert('lowercase'),
    '"lowercase" must not contain only lowercase letters',
));

test('Scenario #3', expectFullMessage(
    fn() => v::lowercase()->assert('UPPERCASE'),
    '- "UPPERCASE" must contain only lowercase letters',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::lowercase())->assert('lowercase'),
    '- "lowercase" must not contain only lowercase letters',
));
