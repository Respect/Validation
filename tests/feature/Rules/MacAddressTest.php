<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::macAddress()->assert('00-11222:33:44:55'),
    '"00-11222:33:44:55" must be a valid MAC address',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::macAddress())->assert('00:11:22:33:44:55'),
    '"00:11:22:33:44:55" must not be a valid MAC address',
));

test('Scenario #3', expectFullMessage(
    fn() => v::macAddress()->assert('90-bc-nk:1a-dd-cc'),
    '- "90-bc-nk:1a-dd-cc" must be a valid MAC address',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::macAddress())->assert('AF:0F:bd:12:44:ba'),
    '- "AF:0F:bd:12:44:ba" must not be a valid MAC address',
));
