<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::currencyCode()->assert('batman'),
    fn(string $message) => expect($message)->toBe('"batman" must be a currency code'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::currencyCode())->assert('BRL'),
    fn(string $message) => expect($message)->toBe('"BRL" must not be a currency code'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::currencyCode()->assert('ppz'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "ppz" must be a currency code'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::currencyCode())->assert('GBP'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "GBP" must not be a currency code'),
));
