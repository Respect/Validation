<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Scenario #1', expectMessage(
    fn() => v::pesel()->assert('21120209251'),
    '"21120209251" must be a valid PESEL',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::pesel())->assert('21120209256'),
    '"21120209256" must not be a valid PESEL',
));

test('Scenario #3', expectFullMessage(
    fn() => v::pesel()->assert('21120209251'),
    '- "21120209251" must be a valid PESEL',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::pesel())->assert('21120209256'),
    '- "21120209256" must not be a valid PESEL',
));
