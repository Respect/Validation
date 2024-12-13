<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::tld()->assert('42'),
    '"42" must be a valid top-level domain name',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::tld())->assert('com'),
    '"com" must not be a valid top-level domain name',
));

test('Scenario #3', expectFullMessage(
    fn() => v::tld()->assert('1984'),
    '- "1984" must be a valid top-level domain name',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::tld())->assert('com'),
    '- "com" must not be a valid top-level domain name',
));
