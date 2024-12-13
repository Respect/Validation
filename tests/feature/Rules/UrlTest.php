<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::url()->assert('example.com'),
    '"example.com" must be a URL',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::url())->assert('http://example.com'),
    '"http://example.com" must not be a URL',
));

test('Scenario #3', expectFullMessage(
    fn() => v::url()->assert('example.com'),
    '- "example.com" must be a URL',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::url())->assert('http://example.com'),
    '- "http://example.com" must not be a URL',
));
