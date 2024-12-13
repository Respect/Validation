<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::endsWith('foo')->assert('bar'),
    '"bar" must end with "foo"',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::endsWith('foo'))->assert(['bar', 'foo']),
    '`["bar", "foo"]` must not end with "foo"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::endsWith('foo')->assert(''),
    '- "" must end with "foo"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::endsWith('foo'))->assert(['bar', 'foo']),
    '- `["bar", "foo"]` must not end with "foo"',
));
