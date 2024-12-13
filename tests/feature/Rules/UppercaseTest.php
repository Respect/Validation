<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::uppercase()->assert('lowercase'),
    '"lowercase" must contain only uppercase letters',
));

test('Scenario #2', expectFullMessage(
    fn() => v::uppercase()->assert('lowercase'),
    '- "lowercase" must contain only uppercase letters',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::uppercase())->assert('UPPERCASE'),
    '"UPPERCASE" must not contain only uppercase letters',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::uppercase())->assert('UPPERCASE'),
    '- "UPPERCASE" must not contain only uppercase letters',
));
