<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

$array = ['foo' => true, 'bar' => 42];

test('Scenario #1', expectMessageAndError(
    fn() => v::key('baz')->assert($array),
    'baz must be present',
    'Calling key() without a second parameter has been deprecated, and will be not be allowed in the next major version. Use keyExists() instead.',
));

test('Scenario #2', expectMessageAndError(
    fn() => v::not(v::key('foo'))->assert($array),
    'foo must not be present',
    'Calling key() without a second parameter has been deprecated, and will be not be allowed in the next major version. Use keyExists() instead.',
));

test('Scenario #3', expectMessageAndError(
    fn() => v::key('foo', v::falseVal(), true)->assert($array),
    'foo must evaluate to `false`',
    'Calling key() with a third parameter has been deprecated, and will be not be allowed in the next major version. Use key() without the third parameter.',
));

test('Scenario #4', expectMessageAndError(
    fn() => v::not(v::key('foo', v::trueVal(), true))->assert($array),
    'foo must not evaluate to `true`',
    'Calling key() with a third parameter has been deprecated, and will be not be allowed in the next major version. Use key() without the third parameter.',
));

test('Scenario #5', expectMessageAndError(
    fn() => v::key('foo', v::falseVal(), false)->assert($array),
    'foo must evaluate to `false`',
    'Calling key() with a third parameter has been deprecated, and will be not be allowed in the next major version. Use keyOptional() instead.',
));

test('Scenario #6', expectMessageAndError(
    fn() => v::not(v::key('foo', v::trueVal(), false))->assert($array),
    'foo must not evaluate to `true`',
    'Calling key() with a third parameter has been deprecated, and will be not be allowed in the next major version. Use keyOptional() instead.',
));
