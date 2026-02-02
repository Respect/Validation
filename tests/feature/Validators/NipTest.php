<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Scenario #1', catchMessage(
    fn() => v::nip()->assert('1645865778'),
    fn(string $message) => expect($message)->toBe('"1645865778" must be a Polish VAT identification number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::nip())->assert('1645865777'),
    fn(string $message) => expect($message)->toBe('"1645865777" must not be a Polish VAT identification number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::nip()->assert('1645865778'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1645865778" must be a Polish VAT identification number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::nip())->assert('1645865777'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1645865777" must not be a Polish VAT identification number'),
));
