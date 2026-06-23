<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\Test\Stubs\CyclicNode;
use Respect\Validation\Test\Stubs\NestedAddress;
use Respect\Validation\Test\Stubs\NestedWithAttributes;
use Respect\Validation\Test\Stubs\WithAttributes;
use Respect\Validation\Test\Stubs\WithCyclicAttributes;
use Respect\Validation\Test\Stubs\WithIntersectionTypeNested;
use Respect\Validation\Test\Stubs\WithNestedAttributes;
use Respect\Validation\Test\Stubs\WithUnionTypeNested;

test('Default', catchAll(
    fn() => v::attributes()->assert(new WithAttributes('', '2024-06-23', 'john.doe@gmail.com')),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.name` must be defined')
        ->and($fullMessage)->toBe('- `.name` must be defined')
        ->and($messages)->toBe(['name' => '`.name` must be defined']),
));

test('Inverted', catchAll(
    fn() => v::attributes()->assert(new WithAttributes('John Doe', '2024-06-23', 'john.doe@gmail.com', '+1234567890')),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.phone` must be a phone number or must be null')
        ->and($fullMessage)->toBe('- `.phone` must be a phone number or must be null')
        ->and($messages)->toBe(['phone' => '`.phone` must be a phone number or must be null']),
));

test('Not an object', catchAll(
    fn() => v::attributes()->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[]` must be an object')
        ->and($fullMessage)->toBe('- `[]` must be an object')
        ->and($messages)->toBe(['attributes' => '`[]` must be an object']),
));

test('Nullable', catchAll(
    fn() => v::attributes()->assert(new WithAttributes('John Doe', '2024-06-23', 'john.doe@gmail.com', 'not a phone number')),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.phone` must be a phone number or must be null')
        ->and($fullMessage)->toBe('- `.phone` must be a phone number or must be null')
        ->and($messages)->toBe(['phone' => '`.phone` must be a phone number or must be null']),
));

test('Multiple attributes, all failed', catchAll(
    fn() => v::attributes()->assert(new WithAttributes('', 'not a date', 'not an email', 'not a phone number')),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.name` must be defined')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - `Respect\Validation\Test\Stubs\WithAttributes { +$name="" +$birthdate="not a date" #$phone="not a phone number" + ... }` must pass the rules
              - `.name` must be defined
              - `.birthdate` must pass all the rules
                - `.birthdate` must be a date in the "2005-12-30" format
                - For comparison with now, `.birthdate` must be a datetime
              - `.phone` must be a phone number or must be null
              - `.email` must be an email address or must be null
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`Respect\Validation\Test\Stubs\WithAttributes { +$name="" +$birthdate="not a date" #$phone="not a phone number" + ... }` must pass the rules',
            'name' => '`.name` must be defined',
            'birthdate' => [
                '__root__' => '`.birthdate` must pass all the rules',
                0 => '`.birthdate` must be a date in the "2005-12-30" format',
                1 => 'For comparison with now, `.birthdate` must be a datetime',
            ],
            'phone' => '`.phone` must be a phone number or must be null',
            'email' => '`.email` must be an email address or must be null',
        ]),
));

test('Failed attributes on the class', catchAll(
    fn() => v::attributes()->assert(new WithAttributes('John Doe', '2024-06-23')),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.email` must be defined')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `Respect\Validation\Test\Stubs\WithAttributes { +$name="John Doe" +$birthdate="2024-06-23" #$phone=null +$address ... }` must pass at least one of the rules
          - `.email` must be defined
          - `.phone` must be defined
        FULL_MESSAGE)
        ->and($messages)->toBe([
            'anyOf' => [
                '__root__' => '`Respect\Validation\Test\Stubs\WithAttributes { +$name="John Doe" +$birthdate="2024-06-23" #$phone=null +$address ... }` must pass at least one of the rules',
                'email' => '`.email` must be defined',
                'phone' => '`.phone` must be defined',
            ],
        ]),
));

test('Multiple attributes, one failed', catchAll(
    fn() => v::attributes()->assert(new WithAttributes('John Doe', '22 years ago', 'john.doe@gmail.com')),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.birthdate` must be a date in the "2005-12-30" format')
        ->and($fullMessage)->toBe('- `.birthdate` must be a date in the "2005-12-30" format')
        ->and($messages)->toBe(['birthdate' => '`.birthdate` must be a date in the "2005-12-30" format']),
));

test('Recursive: invalid nested object property', catchAll(
    fn() => v::attributes()->assert(new WithNestedAttributes('John Doe', new NestedAddress('', 'Springfield'))),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.address.street` must be defined')
        ->and($fullMessage)->toBe('- `.address.street` must be defined')
        ->and($messages)->toBe(['address' => '`.address.street` must be defined']),
));

test('Recursive: union type with invalid nested object property', catchAll(
    fn() => v::attributes()->assert(new WithUnionTypeNested('John Doe', new NestedAddress('', 'Springfield'))),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.address.street` must be defined')
        ->and($fullMessage)->toBe('- `.address.street` must be defined')
        ->and($messages)->toBe(['address' => '`.address.street` must be defined']),
));

test('Recursive: intersection type with invalid nested object property', catchAll(
    fn() => v::attributes()->assert(new WithIntersectionTypeNested('John Doe', new NestedWithAttributes('', 'Springfield'))),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.address.street` must be defined')
        ->and($fullMessage)->toBe('- `.address.street` must be defined')
        ->and($messages)->toBe(['address' => '`.address.street` must be defined']),
));

test('Circular reference: self-referencing', catchAll(
    fn() => (function (): void {
        $node = new CyclicNode('hello');
        $node->next = $node;
        v::attributes()->assert(new WithCyclicAttributes('John Doe', $node));
    })(),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.next.next` must not contain a circular reference or must be null')
        ->and($fullMessage)->toBe('- `.next.next` must not contain a circular reference or must be null')
        ->and($messages)->toBe(['next' => '`.next.next` must not contain a circular reference or must be null']),
));
