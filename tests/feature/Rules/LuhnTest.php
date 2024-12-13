<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::luhn()->assert('2222400041240021'),
    '"2222400041240021" must be a valid Luhn number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::luhn())->assert('2223000048400011'),
    '"2223000048400011" must not be a valid Luhn number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::luhn()->assert('340316193809334'),
    '- "340316193809334" must be a valid Luhn number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::luhn())->assert('6011000990139424'),
    '- "6011000990139424" must not be a valid Luhn number',
));
