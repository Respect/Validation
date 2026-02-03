<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::luhn()->assert('2222400041240021'),
    fn(string $message) => expect($message)->toBe('"2222400041240021" must be a valid Luhn number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::luhn())->assert('2223000048400011'),
    fn(string $message) => expect($message)->toBe('"2223000048400011" must not be a valid Luhn number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::luhn()->assert('340316193809334'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "340316193809334" must be a valid Luhn number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::luhn())->assert('6011000990139424'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "6011000990139424" must not be a valid Luhn number'),
));
