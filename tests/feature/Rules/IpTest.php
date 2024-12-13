<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::ip()->assert('257.0.0.1'),
    '"257.0.0.1" must be an IP address',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::ip())->assert('127.0.0.1'),
    '"127.0.0.1" must not be an IP address',
));

test('Scenario #3', expectMessage(
    fn() => v::ip('127.0.1.*')->assert('127.0.0.1'),
    '"127.0.0.1" must be an IP address in the 127.0.1.0-127.0.1.255 range',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::ip('127.0.1.*'))->assert('127.0.1.1'),
    '"127.0.1.1" must not be an IP address in the 127.0.1.0-127.0.1.255 range',
));

test('Scenario #5', expectFullMessage(
    fn() => v::ip()->assert('257.0.0.1'),
    '- "257.0.0.1" must be an IP address',
));

test('Scenario #6', expectFullMessage(
    fn() => v::not(v::ip())->assert('127.0.0.1'),
    '- "127.0.0.1" must not be an IP address',
));

test('Scenario #7', expectFullMessage(
    fn() => v::ip('127.0.1.*')->assert('127.0.0.1'),
    '- "127.0.0.1" must be an IP address in the 127.0.1.0-127.0.1.255 range',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::ip('127.0.1.*'))->assert('127.0.1.1'),
    '- "127.0.1.1" must not be an IP address in the 127.0.1.0-127.0.1.255 range',
));
