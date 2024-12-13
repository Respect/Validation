<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::containsAny(['foo', 'bar'])->assert('baz'),
    '"baz" must contain at least one value from `["foo", "bar"]`',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::containsAny(['foo', 'bar']))->assert('fool'),
    '"fool" must not contain any value from `["foo", "bar"]`',
));

test('Scenario #3', expectFullMessage(
    fn() => v::containsAny(['foo', 'bar'])->assert(['baz']),
    '- `["baz"]` must contain at least one value from `["foo", "bar"]`',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::containsAny(['foo', 'bar'], true))->assert(['bar', 'foo']),
    '- `["bar", "foo"]` must not contain any value from `["foo", "bar"]`',
));
