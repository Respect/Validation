<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::named('Potato', v::stringType())->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Potato must be a string')
        ->and($fullMessage)->toBe('- Potato must be a string')
        ->and($messages)->toBe(['stringType' => 'Potato must be a string']),
));

test('Inverted', catchAll(
    fn() => v::not(v::named('Zucchini', v::intType()))->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Zucchini must not be an integer')
        ->and($fullMessage)->toBe('- Zucchini must not be an integer')
        ->and($messages)->toBe(['notIntType' => 'Zucchini must not be an integer']),
));

test('Template in Validator', catchAll(
    fn() => v::named('Mushroom', v::named('Eggplant', v::stringType()))
        ->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Eggplant must be a string')
        ->and($fullMessage)->toBe('- Eggplant must be a string')
        ->and($messages)->toBe(['stringType' => 'Eggplant must be a string']),
));

test('With bound', catchAll(
    fn() => v::named('Pumpkin', v::attributes())->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Pumpkin must be an object')
        ->and($fullMessage)->toBe('- Pumpkin must be an object')
        ->and($messages)->toBe(['attributes' => 'Pumpkin must be an object']),
));

test('With key that does not exist', catchAll(
    fn() => v::key('vegetable', v::named('Paprika', v::stringType()))->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Paprika must be present')
        ->and($fullMessage)->toBe('- Paprika must be present')
        ->and($messages)->toBe(['vegetable' => 'Paprika must be present']),
));

test('With property that does not exist', catchAll(
    fn() => v::key('vegetable', v::named('Broccoli', v::stringType()))->assert((object) []),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Broccoli must be present')
        ->and($fullMessage)->toBe('- Broccoli must be present')
        ->and($messages)->toBe(['vegetable' => 'Broccoli must be present']),
));

test('With key that fails validation', catchAll(
    fn() => v::key('vegetable', v::named('Artichoke', v::stringType()))->assert(['vegetable' => 12]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Artichoke must be a string')
        ->and($fullMessage)->toBe('- Artichoke must be a string')
        ->and($messages)->toBe(['vegetable' => 'Artichoke must be a string']),
));

test('With nested key that fails validation', catchAll(
    fn() => v::key(
        'vegetables',
        v::named(
            'Vegetables',
            v::init()
                ->key('root', v::stringType())
                ->key('stems', v::stringType())
                ->keyExists('fruits'),
        ),
    )->assert(['vegetables' => ['root' => 12, 'stems' => 12]]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.vegetables.root` (<- Vegetables) must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Vegetables must pass all the rules
          - `.vegetables.root` must be a string
          - `.vegetables.stems` must be a string
          - `.vegetables.fruits` must be present
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Vegetables must pass all the rules',
            'root' => '`.vegetables.root` must be a string',
            'stems' => '`.vegetables.stems` must be a string',
            'fruits' => '`.vegetables.fruits` must be present',
        ]),
));
