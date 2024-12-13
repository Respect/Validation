<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::imei()->assert('490154203237512'),
    '"490154203237512" must be a valid IMEI number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::imei())->assert('350077523237513'),
    '"350077523237513" must not be a valid IMEI number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::imei()->assert(null),
    '- `null` must be a valid IMEI number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::imei())->assert('356938035643809'),
    '- "356938035643809" must not be a valid IMEI number',
));
