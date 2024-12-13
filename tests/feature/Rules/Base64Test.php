<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::base64()->assert('=c3VyZS4'),
    '"=c3VyZS4" must be a base64 encoded string',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::base64())->assert('c3VyZS4='),
    '"c3VyZS4=" must not be a base64 encoded string',
));

test('Scenario #3', expectFullMessage(
    fn() => v::base64()->assert('=c3VyZS4'),
    '- "=c3VyZS4" must be a base64 encoded string',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::base64())->assert('c3VyZS4='),
    '- "c3VyZS4=" must not be a base64 encoded string',
));
