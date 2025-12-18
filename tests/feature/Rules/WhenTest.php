<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('When valid use "then"', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must be a positive number')
        ->and($fullMessage)->toBe('- -1 must be a positive number')
        ->and($messages)->toBe(['positive' => '-1 must be a positive number'])
));

test('When invalid use "else"', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert(''),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"" must not be empty')
        ->and($fullMessage)->toBe('- "" must not be empty')
        ->and($messages)->toBe(['notEmpty' => '"" must not be empty'])
));

test('When valid use "then" using single template', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert(-1, 'That did not go as planned'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('That did not go as planned')
        ->and($fullMessage)->toBe('- That did not go as planned')
        ->and($messages)->toBe(['positive' => 'That did not go as planned'])
));

test('When invalid use "else" using single template', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert('', 'That could have been better'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('That could have been better')
        ->and($fullMessage)->toBe('- That could have been better')
        ->and($messages)->toBe(['notEmpty' => 'That could have been better'])
));

test('When valid use "then" using array template', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert(-1, [
        'notEmpty' => '--Never shown--',
        'positive' => 'Not positive',
    ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not positive')
        ->and($fullMessage)->toBe('- Not positive')
        ->and($messages)->toBe(['positive' => 'Not positive'])
));

test('When invalid use "else" using array template', catchAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert('', [
        'notEmpty' => 'Not empty',
        'positive' => '--Never shown--',
    ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not empty')
        ->and($fullMessage)->toBe('- Not empty')
        ->and($messages)->toBe(['notEmpty' => 'Not empty'])
));
