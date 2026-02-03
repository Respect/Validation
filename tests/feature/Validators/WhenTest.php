<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('When valid use "then"', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notBlank())->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must be a positive number')
        ->and($fullMessage)->toBe('- -1 must be a positive number')
        ->and($messages)->toBe(['positive' => '-1 must be a positive number']),
));

test('When invalid use "else"', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notBlank())->assert(''),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"" must not be blank')
        ->and($fullMessage)->toBe('- "" must not be blank')
        ->and($messages)->toBe(['notBlank' => '"" must not be blank']),
));

test('When valid use "then" using single template', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notBlank())->assert(-1, 'That did not go as planned'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('That did not go as planned')
        ->and($fullMessage)->toBe('- That did not go as planned')
        ->and($messages)->toBe(['positive' => 'That did not go as planned']),
));

test('When invalid use "else" using single template', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notBlank())->assert('', 'That could have been better'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('That could have been better')
        ->and($fullMessage)->toBe('- That could have been better')
        ->and($messages)->toBe(['notBlank' => 'That could have been better']),
));

test('When valid use "then" using array template', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notBlank())->assert(-1, [
        'notBlank' => '--Never shown--',
        'positive' => 'Not positive',
    ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not positive')
        ->and($fullMessage)->toBe('- Not positive')
        ->and($messages)->toBe(['positive' => 'Not positive']),
));

test('When invalid use "else" using array template', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notBlank())->assert('', [
        'notBlank' => 'Not empty',
        'positive' => '--Never shown--',
    ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not empty')
        ->and($fullMessage)->toBe('- Not empty')
        ->and($messages)->toBe(['notBlank' => 'Not empty']),
));
