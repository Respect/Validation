<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::alwaysInvalid()->assert('whatever'),
    '"whatever" must be valid',
));

test('Scenario #2', expectFullMessage(
    fn() => v::alwaysInvalid()->assert(''),
    '- "" must be valid',
));
