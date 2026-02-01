<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Default: fail, fail', catchAll(
    fn() => v::allOf(v::intType(), v::negative())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - "string" must pass all the rules
              - "string" must be an integer
              - "string" must be a negative number
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"string" must pass all the rules',
            'intType' => '"string" must be an integer',
            'negative' => '"string" must be a negative number',
        ]),
));

test('Default: fail, pass', catchAll(
    fn() => v::allOf(v::intType(), v::stringType())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe('- "string" must be an integer')
        ->and($messages)->toBe(['intType' => '"string" must be an integer']),
));

test('Default: fail, fail, pass', catchAll(
    fn() => v::allOf(v::intType(), v::positive(), v::stringType())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - "string" must pass the rules
              - "string" must be an integer
              - "string" must be a positive number
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"string" must pass the rules',
            'intType' => '"string" must be an integer',
            'positive' => '"string" must be a positive number',
        ]),
));

test('Inverted: pass, pass', catchAll(
    fn() => v::not(v::allOf(v::intType(), v::negative()))->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must not be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - -1 must pass the rules
              - -1 must not be an integer
              - -1 must not be a negative number
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '-1 must pass the rules',
            'intType' => '-1 must not be an integer',
            'negative' => '-1 must not be a negative number',
        ]),
));

test('Inverted: pass, fail, fail', catchAll(
    fn() => v::allOf(v::intType(), v::alpha(), v::stringType())->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('2 must consist only of letters (a-z)')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - 2 must pass the rules
              - 2 must consist only of letters (a-z)
              - 2 must be a string
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '2 must pass the rules',
            'alpha' => '2 must consist only of letters (a-z)',
            'stringType' => '2 must be a string',
        ]),
));

test('Wrapping "not"', catchAll(
    fn() => v::allOf(v::not(v::intType()), v::greaterThan(2))->assert(4),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('4 must not be an integer')
        ->and($fullMessage)->toBe('- 4 must not be an integer')
        ->and($messages)->toBe(['notIntType' => '4 must not be an integer']),
));

test('With a single template', catchAll(
    fn() => v::allOf(v::stringType(), v::arrayType())->assert(5, 'This is a single template'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('This is a single template')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - This is a single template
              - 5 must be a string
              - 5 must be an array
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'This is a single template',
            'stringType' => '5 must be a string',
            'arrayType' => '5 must be an array',
        ]),
));

test('With multiple templates', catchAll(
    fn() => v::allOf(v::stringType(), v::uppercase())->assert(5, [
        '__root__' => 'Two things are wrong',
        'stringType' => 'Template for "stringType"',
        'uppercase' => 'Template for "uppercase"',
    ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template for "stringType"')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - Two things are wrong
              - Template for "stringType"
              - Template for "uppercase"
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Two things are wrong',
            'stringType' => 'Template for "stringType"',
            'uppercase' => 'Template for "uppercase"',
        ]),
));

test('short-circuit: first validator fails', catchAll(
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

test('short-circuit: inverted when all validators pass', catchAll(
    fn() => v::not(v::shortCircuit(v::allOf(v::intType(), v::negative())))->assert(-1),
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
