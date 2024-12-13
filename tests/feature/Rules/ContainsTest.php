<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::contains('foo')->assert('bar'),
    '"bar" must contain "foo"',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::contains('foo'))->assert('fool'),
    '"fool" must not contain "foo"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::contains('foo')->assert(['bar']),
    '- `["bar"]` must contain "foo"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::contains('foo', true))->assert(['bar', 'foo']),
    '- `["bar", "foo"]` must not contain "foo"',
));
