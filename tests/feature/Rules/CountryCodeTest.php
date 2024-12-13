<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::countryCode()->assert('1'),
    '"1" must be a valid country code',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::countryCode())->assert('BR'),
    '"BR" must not be a valid country code',
));

test('Scenario #3', expectFullMessage(
    fn() => v::countryCode()->assert('1'),
    '- "1" must be a valid country code',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::countryCode())->assert('BR'),
    '- "BR" must not be a valid country code',
));
