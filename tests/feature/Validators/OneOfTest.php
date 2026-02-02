<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Default: fail, fail', catchAll(
    fn() => v::oneOf(v::intType(), v::negative())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "string" must pass one of the rules
          - "string" must be an integer
          - "string" must be a negative number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"string" must pass one of the rules',
            'intType' => '"string" must be an integer',
            'negative' => '"string" must be a negative number',
        ]),
));

test('Default: fail, pass, pass', catchAll(
    fn() => v::oneOf(v::intType(), v::stringType(), v::alpha())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "string" must pass only one of the rules
          - "string" must be an integer
          - "string" must be a string
          - "string" must consist only of letters (a-z)
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"string" must pass only one of the rules',
            'intType' => '"string" must be an integer',
            'stringType' => '"string" must be a string',
            'alpha' => '"string" must consist only of letters (a-z)',
        ]),
));

test('Default: pass, fail, pass', catchAll(
    fn() => v::oneOf(v::stringType(), v::intType(), v::alpha())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "string" must pass only one of the rules
          - "string" must be an integer
          - "string" must be a string
          - "string" must consist only of letters (a-z)
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"string" must pass only one of the rules',
            'intType' => '"string" must be an integer',
            'stringType' => '"string" must be a string',
            'alpha' => '"string" must consist only of letters (a-z)',
        ]),
));

test('Default: pass, pass, fail', catchAll(
    fn() => v::oneOf(v::stringType(), v::alpha(), v::intType())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "string" must pass only one of the rules
          - "string" must be an integer
          - "string" must be a string
          - "string" must consist only of letters (a-z)
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"string" must pass only one of the rules',
            'intType' => '"string" must be an integer',
            'stringType' => '"string" must be a string',
            'alpha' => '"string" must consist only of letters (a-z)',
        ]),
));

test('Inverted: fail, pass', catchAll(
    fn() => v::not(v::oneOf(v::intType(), v::positive()))->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must not be an integer')
        ->and($fullMessage)->toBe('- -1 must not be an integer')
        ->and($messages)->toBe(['intType' => '-1 must not be an integer']),
));

test('Inverted: fail, fail, pass', catchAll(
    fn() => v::not(v::oneOf(v::stringType(), v::alpha(), v::negative()))->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must not be a negative number')
        ->and($fullMessage)->toBe('- -1 must not be a negative number')
        ->and($messages)->toBe(['negative' => '-1 must not be a negative number']),
));
