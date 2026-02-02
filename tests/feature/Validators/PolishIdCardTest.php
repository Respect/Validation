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
    fn() => v::polishIdCard()->assert('AYE205411'),
    fn(string $message) => expect($message)->toBe('"AYE205411" must be a Polish Identity Card number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::polishIdCard())->assert('AYE205410'),
    fn(string $message) => expect($message)->toBe('"AYE205410" must not be a Polish Identity Card number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::polishIdCard()->assert('AYE205411'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "AYE205411" must be a Polish Identity Card number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::polishIdCard())->assert('AYE205410'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "AYE205410" must not be a Polish Identity Card number'),
));
