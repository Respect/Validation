<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

$object = new stdClass();
$object->foo = true;
$object->bar = 42;

test('Scenario #1', expectMessageAndError(
    fn() => v::attribute('baz')->assert($object),
    '`.baz` must be present',
    'The attribute() rule has been deprecated and will be removed in the next major version. Use propertyExists() instead.',
));

test('Scenario #2', expectMessageAndError(
    fn() => v::not(v::attribute('foo'))->assert($object),
    '`.foo` must not be present',
    'The attribute() rule has been deprecated and will be removed in the next major version. Use propertyExists() instead.',
));

test('Scenario #3', expectMessageAndError(
    fn() => v::attribute('foo', v::falseVal())->assert($object),
    '`.foo` must evaluate to `false`',
    'The attribute() rule has been deprecated and will be removed in the next major version. Use property() instead.',
));

test('Scenario #4', expectMessageAndError(
    fn() => v::not(v::attribute('foo', v::trueVal()))->assert($object),
    '`.foo` must not evaluate to `true`',
    'The attribute() rule has been deprecated and will be removed in the next major version. Use property() instead.',
));

test('Scenario #5', expectMessageAndError(
    fn() => v::attribute('foo', v::falseVal(), true)->assert($object),
    '`.foo` must evaluate to `false`',
    'The attribute() rule has been deprecated and will be removed in the next major version. Use property() instead.',
));

test('Scenario #6', expectMessageAndError(
    fn() => v::not(v::attribute('foo', v::trueVal(), true))->assert($object),
    '`.foo` must not evaluate to `true`',
    'The attribute() rule has been deprecated and will be removed in the next major version. Use property() instead.',
));

test('Scenario #7', expectMessageAndError(
    fn() => v::attribute('foo', v::falseVal(), false)->assert($object),
    '`.foo` must evaluate to `false`',
    'The attribute() rule has been deprecated and will be removed in the next major version. Use propertyOptional() instead.',
));

test('Scenario #8', expectMessageAndError(
    fn() => v::not(v::attribute('foo', v::trueVal(), false))->assert($object),
    '`.foo` must not evaluate to `true`',
    'The attribute() rule has been deprecated and will be removed in the next major version. Use propertyOptional() instead.',
));
