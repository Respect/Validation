<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('input is not a string', catchAll(
    fn() => v::patterned('0{3}.0{3}.0{3}-0{2}', v::cpf())->assert(new stdClass()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`stdClass {}` must be a string value')
        ->and($fullMessage)->toBe('- `stdClass {}` must be a string value')
        ->and($messages)->toBe(['cpf' => '`stdClass {}` must be a string value']),
));

test('failed validator', catchAll(
    fn() => v::patterned('0{3}.0{3}.0{3}-0{2}', v::cpf())->assert('12345678900'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"123.456.789-00" must be a valid CPF number')
        ->and($fullMessage)->toBe('- "123.456.789-00" must be a valid CPF number')
        ->and($messages)->toBe(['cpf' => '"123.456.789-00" must be a valid CPF number']),
));
