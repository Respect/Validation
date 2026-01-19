<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Default: fail, fail', catchAll(
    fn() => v::noneOf(v::intType(), v::negative())->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must not be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - -1 must pass all the rules
          - -1 must not be an integer
          - -1 must not be a negative number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '-1 must pass all the rules',
            'intType' => '-1 must not be an integer',
            'negative' => '-1 must not be a negative number',
        ]),
));

test('Default: pass, fail', catchAll(
    fn() => v::noneOf(v::intType(), v::stringType())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must not be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "string" must not be a string
        FULL_MESSAGE)
        ->and($messages)->toBe(['stringType' => '"string" must not be a string']),
));

test('Default: pass, fail, fail', catchAll(
    fn() => v::noneOf(v::intType(), v::alpha(), v::stringType())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must not contain letters (a-z)')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "string" must pass the rules
          - "string" must not contain letters (a-z)
          - "string" must not be a string
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"string" must pass the rules',
            'alpha' => '"string" must not contain letters (a-z)',
            'stringType' => '"string" must not be a string',
        ]),
));

test('Inverted: fail, fail', catchAll(
    fn() => v::not(v::noneOf(v::intType(), v::negative()))->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "string" must pass the rules
          - "string" must be an integer
          - "string" must be a negative number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"string" must pass the rules',
            'intType' => '"string" must be an integer',
            'negative' => '"string" must be a negative number',
        ]),
));
