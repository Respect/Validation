<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::phone()->assert('123'),
    '"123" must be a valid telephone number',
    '- "123" must be a valid telephone number',
    ['phone' => '"123" must be a valid telephone number'],
));

test('Country-specific', expectAll(
    fn() => v::phone('BR')->assert('+1 650 253 00 00'),
    '"+1 650 253 00 00" must be a valid telephone number for country Brazil',
    '- "+1 650 253 00 00" must be a valid telephone number for country Brazil',
    ['phone' => '"+1 650 253 00 00" must be a valid telephone number for country Brazil'],
));

test('Inverted', expectAll(
    fn() => v::not(v::phone())->assert('+55 11 91111 1111'),
    '"+55 11 91111 1111" must not be a valid telephone number',
    '- "+55 11 91111 1111" must not be a valid telephone number',
    ['notPhone' => '"+55 11 91111 1111" must not be a valid telephone number'],
));

test('Default with name', expectAll(
    fn() => v::phone()->setName('Phone')->assert('123'),
    'Phone must be a valid telephone number',
    '- Phone must be a valid telephone number',
    ['phone' => 'Phone must be a valid telephone number'],
));

test('Country-specific with name', expectAll(
    fn() => v::phone('US')->setName('Phone')->assert('123'),
    'Phone must be a valid telephone number for country United States',
    '- Phone must be a valid telephone number for country United States',
    ['phone' => 'Phone must be a valid telephone number for country United States'],
));
