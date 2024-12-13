<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::currencyCode()->assert('batman'),
    '"batman" must be a valid currency code',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::currencyCode())->assert('BRL'),
    '"BRL" must not be a valid currency code',
));

test('Scenario #3', expectFullMessage(
    fn() => v::currencyCode()->assert('ppz'),
    '- "ppz" must be a valid currency code',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::currencyCode())->assert('GBP'),
    '- "GBP" must not be a valid currency code',
));
