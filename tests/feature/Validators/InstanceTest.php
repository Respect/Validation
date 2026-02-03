<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::instance(DateTime::class)->assert(''),
    fn(string $message) => expect($message)->toBe('"" must be an instance of `DateTime`'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::instance(Traversable::class))->assert(new ArrayObject()),
    fn(string $message) => expect($message)->toBe('`ArrayObject { getArrayCopy() => [] }` must not be an instance of `Traversable`'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::instance(ArrayIterator::class)->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must be an instance of `ArrayIterator`'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::instance(stdClass::class))->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must not be an instance of `stdClass`'),
));
