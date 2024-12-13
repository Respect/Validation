<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::creditCard('Discover')->assert(3566002020360505),
    '3566002020360505 must be a valid Discover credit card number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::creditCard('Visa'))->assert(4024007153361885),
    '4024007153361885 must not be a valid Visa credit card number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::creditCard('MasterCard')->assert(3566002020360505),
    '- 3566002020360505 must be a valid MasterCard credit card number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::creditCard())->assert(5555444433331111),
    '- 5555444433331111 must not be a valid credit card number',
));
