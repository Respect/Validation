<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::cpf()->assert('this thing'),
    fn(string $message) => expect($message)->toBe('"this thing" must be a valid CPF number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::cpf())->assert('276.865.775-11'),
    fn(string $message) => expect($message)->toBe('"276.865.775-11" must not be a valid CPF number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::cpf()->assert('your mother'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "your mother" must be a valid CPF number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::cpf())->assert('61836182848'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "61836182848" must not be a valid CPF number'),
));
