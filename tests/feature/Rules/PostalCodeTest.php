<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::postalCode('BR')->assert('1057BV'),
    '"1057BV" must be a valid postal code on "BR"',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::postalCode('NL'))->assert('1057BV'),
    '"1057BV" must not be a valid postal code on "NL"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::postalCode('BR')->assert('1057BV'),
    '- "1057BV" must be a valid postal code on "BR"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::postalCode('NL'))->assert('1057BV'),
    '- "1057BV" must not be a valid postal code on "NL"',
));
