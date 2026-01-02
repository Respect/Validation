<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::undefOr(v::alpha())->assert(1234),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1234 must contain only letters (a-z) or must be undefined')
        ->and($fullMessage)->toBe('- 1234 must contain only letters (a-z) or must be undefined')
        ->and($messages)->toBe(['undefOrAlpha' => '1234 must contain only letters (a-z) or must be undefined']),
));

test('Inverted wrapper', catchAll(
    fn() => v::not(v::undefOr(v::alpha()))->assert('alpha'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"alpha" must not contain letters (a-z) and must not be undefined')
        ->and($fullMessage)->toBe('- "alpha" must not contain letters (a-z) and must not be undefined')
        ->and($messages)->toBe(['notUndefOrAlpha' => '"alpha" must not contain letters (a-z) and must not be undefined']),
));

test('Inverted wrapped', catchAll(
    fn() => v::undefOr(v::not(v::alpha()))->assert('alpha'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"alpha" must not contain letters (a-z) or must be undefined')
        ->and($fullMessage)->toBe('- "alpha" must not contain letters (a-z) or must be undefined')
        ->and($messages)->toBe(['undefOrNotAlpha' => '"alpha" must not contain letters (a-z) or must be undefined']),
));

test('Inverted undefined', catchAll(
    fn() => v::not(v::undefOr(v::alpha()))->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must not contain letters (a-z) and must not be undefined')
        ->and($fullMessage)->toBe('- `null` must not contain letters (a-z) and must not be undefined')
        ->and($messages)->toBe(['notUndefOrAlpha' => '`null` must not contain letters (a-z) and must not be undefined']),
));

test('Inverted undefined, wrapped name', catchAll(
    fn() => v::not(v::undefOr(v::named(v::alpha(), 'Wrapped')))->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must not contain letters (a-z) and must not be undefined')
        ->and($fullMessage)->toBe('- Wrapped must not contain letters (a-z) and must not be undefined')
        ->and($messages)->toBe(['notUndefOrAlpha' => 'Wrapped must not contain letters (a-z) and must not be undefined']),
));

test('Inverted undefined, wrapper name', catchAll(
    fn() => v::not(v::named(v::undefOr(v::alpha()), 'Wrapper'))->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapper must not contain letters (a-z) and must not be undefined')
        ->and($fullMessage)->toBe('- Wrapper must not contain letters (a-z) and must not be undefined')
        ->and($messages)->toBe(['notUndefOrAlpha' => 'Wrapper must not contain letters (a-z) and must not be undefined']),
));

test('Inverted undefined, not name', catchAll(
    fn() => v::named(v::not(v::undefOr(v::alpha())), 'Not')->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not must not contain letters (a-z) and must not be undefined')
        ->and($fullMessage)->toBe('- Not must not contain letters (a-z) and must not be undefined')
        ->and($messages)->toBe(['notUndefOrAlpha' => 'Not must not contain letters (a-z) and must not be undefined']),
));

test('With template', catchAll(
    fn() => v::undefOr(v::alpha())->assert(123, 'Underneath the undulating umbrella'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Underneath the undulating umbrella')
        ->and($fullMessage)->toBe('- Underneath the undulating umbrella')
        ->and($messages)->toBe(['undefOrAlpha' => 'Underneath the undulating umbrella']),
));

test('With array template', catchAll(
    fn() => v::undefOr(v::alpha())->assert(123, ['undefOrAlpha' => 'Undefined number of unique unicorns']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Undefined number of unique unicorns')
        ->and($fullMessage)->toBe('- Undefined number of unique unicorns')
        ->and($messages)->toBe(['undefOrAlpha' => 'Undefined number of unique unicorns']),
));

test('Inverted undefined with template', catchAll(
    fn() => v::not(v::undefOr(v::alpha()))->assert('', ['notUndefOrAlpha' => 'Should not be undefined or alpha']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Should not be undefined or alpha')
        ->and($fullMessage)->toBe('- Should not be undefined or alpha')
        ->and($messages)->toBe(['notUndefOrAlpha' => 'Should not be undefined or alpha']),
));

test('Without adjacent result', catchAll(
    fn() => v::undefOr(v::alpha()->stringType())->assert(1234),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1234 must contain only letters (a-z) or must be undefined')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - 1234 must pass all the rules
          - 1234 must contain only letters (a-z) or must be undefined
          - 1234 must be a string or must be undefined
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '1234 must pass all the rules',
            'undefOrAlpha' => '1234 must contain only letters (a-z) or must be undefined',
            'undefOrStringType' => '1234 must be a string or must be undefined',
        ]),
));

test('Without adjacent result with templates', catchAll(
    fn() => v::undefOr(v::alpha()->stringType())->assert(1234, [
        'undefOrAlpha' => 'Should be nul or alpha',
        'undefOrStringType' => 'Should be nul or string type',
    ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Should be nul or alpha')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - 1234 must pass all the rules
          - Should be nul or alpha
          - Should be nul or string type
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '1234 must pass all the rules',
            'undefOrAlpha' => 'Should be nul or alpha',
            'undefOrStringType' => 'Should be nul or string type',
        ]),
));
