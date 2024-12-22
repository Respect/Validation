<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::betweenExclusive(1, 10)->assert(12),
    '12 must be greater than 1 and less than 10',
    '- 12 must be greater than 1 and less than 10',
    ['betweenExclusive' => '12 must be greater than 1 and less than 10'],
));

test('Inverted', expectAll(
    fn() => v::not(v::betweenExclusive(1, 10))->assert(5),
    '5 must not be greater than 1 or less than 10',
    '- 5 must not be greater than 1 or less than 10',
    ['notBetweenExclusive' => '5 must not be greater than 1 or less than 10'],
));

test('With template', expectAll(
    fn() => v::betweenExclusive(1, 10)->setTemplate('Bewildered bees buzzed between blooming begonias')->assert(12),
    'Bewildered bees buzzed between blooming begonias',
    '- Bewildered bees buzzed between blooming begonias',
    ['betweenExclusive' => 'Bewildered bees buzzed between blooming begonias'],
));

test('With name', expectAll(
    fn() => v::betweenExclusive(1, 10)->setName('Range')->assert(10),
    'Range must be greater than 1 and less than 10',
    '- Range must be greater than 1 and less than 10',
    ['betweenExclusive' => 'Range must be greater than 1 and less than 10'],
));
