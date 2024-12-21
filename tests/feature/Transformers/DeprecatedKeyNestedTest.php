<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

$input = [
    'foo' => (object) [
        'bar' => 123,
    ],
];

test('Scenario #1', expectMessageAndError(
    fn() => v::keyNested('foo.bar.baz')->assert(['foo.bar.baz' => false]),
    '`.foo` must be present',
    'The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead.',
));

test('Scenario #A', expectMessageAndError(
    fn() => v::keyNested('foo.bar.baz')->assert(['foo' => []]),
    '`.foo.bar` must be present',
    'The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead.',
));

test('Scenario #B', expectMessageAndError(
    fn() => v::keyNested('foo.bar.baz')->assert(['foo' => []]),
    '`.foo.bar` must be present',
    'The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead.',
));

test('Scenario #C', expectMessageAndError(
    fn() => v::keyNested('foo.bar.baz')->assert(['foo' => ['bar' => []]]),
    '`.foo.bar.baz` must be present',
    'The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead.',
));

test('Scenario #2', expectMessageAndError(
    fn() => v::keyNested('foo.bar', v::negative())->assert($input),
    '`.foo.bar` must be a negative number',
    'The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead.',
));

test('Scenario #3', expectMessageAndError(
    fn() => v::keyNested('foo.bar', v::stringType())->assert(new ArrayObject($input)),
    '`.foo.bar` must be a string',
    'The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead.',
));

test('Scenario #4', expectMessageAndError(
    fn() => v::keyNested('foo.bar', v::floatType(), false)->assert($input),
    '`.foo.bar` must be float',
    'The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead.',
));
