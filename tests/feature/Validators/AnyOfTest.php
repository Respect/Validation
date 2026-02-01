<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Default: fail, fail', catchAll(
    fn() => v::anyOf(v::intType(), v::negative())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "string" must pass at least one of the rules
          - "string" must be an integer
          - "string" must be a negative number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"string" must pass at least one of the rules',
            'intType' => '"string" must be an integer',
            'negative' => '"string" must be a negative number',
        ]),
));

test('Inverted: pass, pass', catchAll(
    fn() => v::not(v::anyOf(v::intType(), v::negative()))->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must not be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - -1 must pass at least one of the rules
          - -1 must not be an integer
          - -1 must not be a negative number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '-1 must pass at least one of the rules',
            'intType' => '-1 must not be an integer',
            'negative' => '-1 must not be a negative number',
        ]),
));

test('Inverted: pass, pass, fail', catchAll(
    fn() => v::not(v::anyOf(v::intType(), v::negative(), v::stringType()))->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must not be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - -1 must pass at least one of the rules
          - -1 must not be an integer
          - -1 must not be a negative number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '-1 must pass at least one of the rules',
            'intType' => '-1 must not be an integer',
            'negative' => '-1 must not be a negative number',
        ]),
));

test('short-circuit: first validator passes', catchAll(
    fn() => v::shortCircuit(v::intType(), v::negative(), v::greaterThan(10))->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe('- "string" must be an integer')
        ->and($messages)->toBe(['intType' => '"string" must be an integer']),
));

test('short-circuit: second validator fails', catchAll(
    fn() => v::shortCircuit(v::intType(), v::negative(), v::greaterThan(10))->assert(5),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('5 must be a negative number')
        ->and($fullMessage)->toBe('- 5 must be a negative number')
        ->and($messages)->toBe(['negative' => '5 must be a negative number']),
));

test('short-circuit: all validators fail', catchAll(
    fn() => v::shortCircuit(v::intType(), v::negative())->assert(5),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('5 must be a negative number')
        ->and($fullMessage)->toBe('- 5 must be a negative number')
        ->and($messages)->toBe(['negative' => '5 must be a negative number']),
));

test('short-circuit: AnyOf wrapped by ShortCircuit stops on first validator fail', catchAll(
    fn() => v::shortCircuit(v::alwaysInvalid(), v::anyOf(v::stringType(), v::intType()))->assert('hello'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"hello" must be valid')
        ->and($fullMessage)->toBe('- "hello" must be valid')
        ->and($messages)->toBe(['alwaysInvalid' => '"hello" must be valid']),
));

test('short-circuit: AnyOf wrapped by ShortCircuit passes on first match of AnyOf', catchAll(
    fn() => v::shortCircuit(v::stringType(), v::anyOf(v::intType(), v::negative()))->assert(5),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('5 must be a string')
        ->and($fullMessage)->toBe('- 5 must be a string')
        ->and($messages)->toBe(['stringType' => '5 must be a string']),
));

test('short-circuit: AnyOf wrapped by ShortCircuit passes on second match of AnyOf', catchAll(
    fn() => v::shortCircuit(v::stringType(), v::anyOf(v::intType(), v::negative()))->assert(-5),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-5 must be a string')
        ->and($fullMessage)->toBe('- -5 must be a string')
        ->and($messages)->toBe(['stringType' => '-5 must be a string']),
));

test('short-circuit: AnyOf wrapped by ShortCircuit fails when AnyOf all fail', catchAll(
    fn() => v::shortCircuit(v::stringType(), v::anyOf(v::intType(), v::negative()))->assert(3.14),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('3.14 must be a string')
        ->and($fullMessage)->toBe('- 3.14 must be a string')
        ->and($messages)->toBe(['stringType' => '3.14 must be a string']),
));

test('short-circuit: inverted when all validators pass', catchAll(
    fn() => v::not(v::shortCircuit(v::anyOf(v::intType(), v::negative())))->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must not be an integer')
        ->and($fullMessage)->toBe('- -1 must not be an integer')
        ->and($messages)->toBe(['intType' => '-1 must not be an integer']),
));
