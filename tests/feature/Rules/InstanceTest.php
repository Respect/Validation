<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::instance(DateTime::class)->assert(''),
    '"" must be an instance of `DateTime`',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::instance(Traversable::class))->assert(new ArrayObject()),
    '`ArrayObject { getArrayCopy() => [] }` must not be an instance of `Traversable`',
));

test('Scenario #3', expectFullMessage(
    fn() => v::instance(ArrayIterator::class)->assert(new stdClass()),
    '- `stdClass {}` must be an instance of `ArrayIterator`',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::instance(stdClass::class))->assert(new stdClass()),
    '- `stdClass {}` must not be an instance of `stdClass`',
));
