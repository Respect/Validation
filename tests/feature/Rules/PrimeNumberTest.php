<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::primeNumber()->assert(10),
    '10 must be a prime number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::primeNumber())->assert(3),
    '3 must not be a prime number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::primeNumber()->assert('Foo'),
    '- "Foo" must be a prime number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::primeNumber())->assert('+7'),
    '- "+7" must not be a prime number',
));
