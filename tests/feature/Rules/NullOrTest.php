<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::nullOr(v::alpha())->assert(1234),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1234 must contain only letters (a-z) or must be null')
        ->and($fullMessage)->toBe('- 1234 must contain only letters (a-z) or must be null')
        ->and($messages)->toBe(['nullOrAlpha' => '1234 must contain only letters (a-z) or must be null']),
));

test('Inverted wrapper', catchAll(
    fn() => v::not(v::nullOr(v::alpha()))->assert('alpha'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"alpha" must not contain letters (a-z) and must not be null')
        ->and($fullMessage)->toBe('- "alpha" must not contain letters (a-z) and must not be null')
        ->and($messages)->toBe(['notNullOrAlpha' => '"alpha" must not contain letters (a-z) and must not be null']),
));

test('Inverted wrapped', catchAll(
    fn() => v::nullOr(v::not(v::alpha()))->assert('alpha'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"alpha" must not contain letters (a-z) or must be null')
        ->and($fullMessage)->toBe('- "alpha" must not contain letters (a-z) or must be null')
        ->and($messages)->toBe(['nullOrNotAlpha' => '"alpha" must not contain letters (a-z) or must be null']),
));

test('Inverted nullined', catchAll(
    fn() => v::not(v::nullOr(v::alpha()))->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must not contain letters (a-z) and must not be null')
        ->and($fullMessage)->toBe('- `null` must not contain letters (a-z) and must not be null')
        ->and($messages)->toBe(['notNullOrAlpha' => '`null` must not contain letters (a-z) and must not be null']),
));

test('Inverted nullined, wrapped name', catchAll(
    fn() => v::not(v::nullOr(v::named(v::alpha(), 'Wrapped')))->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must not contain letters (a-z) and must not be null')
        ->and($fullMessage)->toBe('- Wrapped must not contain letters (a-z) and must not be null')
        ->and($messages)->toBe(['notNullOrAlpha' => 'Wrapped must not contain letters (a-z) and must not be null']),
));

test('Inverted nullined, wrapper name', catchAll(
    fn() => v::not(v::named(v::nullOr(v::alpha()), 'Wrapper'))->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapper must not contain letters (a-z) and must not be null')
        ->and($fullMessage)->toBe('- Wrapper must not contain letters (a-z) and must not be null')
        ->and($messages)->toBe(['notNullOrAlpha' => 'Wrapper must not contain letters (a-z) and must not be null']),
));

test('Inverted nullined, not name', catchAll(
    fn() => v::named(v::not(v::nullOr(v::alpha())), 'Not')->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not must not contain letters (a-z) and must not be null')
        ->and($fullMessage)->toBe('- Not must not contain letters (a-z) and must not be null')
        ->and($messages)->toBe(['notNullOrAlpha' => 'Not must not contain letters (a-z) and must not be null']),
));

test('With template', catchAll(
    fn() => v::nullOr(v::alpha())->assert(123, 'Nine nimble numismatists near Naples'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Nine nimble numismatists near Naples')
        ->and($fullMessage)->toBe('- Nine nimble numismatists near Naples')
        ->and($messages)->toBe(['nullOrAlpha' => 'Nine nimble numismatists near Naples']),
));

test('With array template', catchAll(
    fn() => v::nullOr(v::alpha())->assert(123, ['nullOrAlpha' => 'Next to nifty null notations']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Next to nifty null notations')
        ->and($fullMessage)->toBe('- Next to nifty null notations')
        ->and($messages)->toBe(['nullOrAlpha' => 'Next to nifty null notations']),
));

test('Inverted nullined with template', catchAll(
    fn() => v::not(v::nullOr(v::alpha()))->assert(null, ['notNullOrAlpha' => 'Next to nifty null notations']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Next to nifty null notations')
        ->and($fullMessage)->toBe('- Next to nifty null notations')
        ->and($messages)->toBe(['notNullOrAlpha' => 'Next to nifty null notations']),
));

test('Without adjacent result', catchAll(
    fn() => v::nullOr(v::alpha()->stringType())->assert(1234),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1234 must contain only letters (a-z) or must be null')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - 1234 must pass all the rules
          - 1234 must contain only letters (a-z) or must be null
          - 1234 must be a string or must be null
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '1234 must pass all the rules',
            'nullOrAlpha' => '1234 must contain only letters (a-z) or must be null',
            'nullOrStringType' => '1234 must be a string or must be null',
        ]),
));

test('Without adjacent result with templates', catchAll(
    fn() => v::nullOr(v::alpha()->stringType())->assert(1234, [
        'nullOrAlpha' => 'Should be nul or alpha',
        'nullOrStringType' => 'Should be nul or string type',
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
            'nullOrAlpha' => 'Should be nul or alpha',
            'nullOrStringType' => 'Should be nul or string type',
        ]),
));
