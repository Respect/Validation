<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Test\Stubs\WithAttributes;

test('Default', expectAll(
    fn() => v::attributes()->assert(new WithAttributes('', '2024-06-23', 'john.doe@gmail.com')),
    '`.name` must not be empty',
    '- `.name` must not be empty',
    ['name' => '`.name` must not be empty'],
));

test('Inverted', expectAll(
    fn() => v::attributes()->assert(new WithAttributes('John Doe', '2024-06-23', 'john.doe@gmail.com', '+1234567890')),
    '`.phone` must be a valid telephone number or must be null',
    '- `.phone` must be a valid telephone number or must be null',
    ['phone' => '`.phone` must be a valid telephone number or must be null'],
));

test('Not an object', expectAll(
    fn() => v::attributes()->assert([]),
    '`[]` must be an object',
    '- `[]` must be an object',
    ['attributes' => '`[]` must be an object'],
));

test('Nullable', expectAll(
    fn() => v::attributes()->assert(new WithAttributes('John Doe', '2024-06-23', 'john.doe@gmail.com', 'not a phone number')),
    '`.phone` must be a valid telephone number or must be null',
    '- `.phone` must be a valid telephone number or must be null',
    ['phone' => '`.phone` must be a valid telephone number or must be null'],
));

test('Multiple attributes, all failed', expectAll(
    fn() => v::attributes()->assert(new WithAttributes('', 'not a date', 'not an email', 'not a phone number')),
    '`.name` must not be empty',
    <<<'FULL_MESSAGE'
    - `Respect\Validation\Test\Stubs\WithAttributes { +$name="" +$birthdate="not a date" +$email="not an email" +$phone ... }` must pass the rules
      - `.name` must not be empty
      - `.birthdate` must pass all the rules
        - `.birthdate` must be a valid date in the format "2005-12-30"
        - For comparison with now, `.birthdate` must be a valid datetime
      - `.email` must be a valid email address or must be null
      - `.phone` must be a valid telephone number or must be null
    FULL_MESSAGE,
    [
        '__root__' => '`Respect\Validation\Test\Stubs\WithAttributes { +$name="" +$birthdate="not a date" +$email="not an email" +$phone ... }` must pass the rules',
        'name' => '`.name` must not be empty',
        'birthdate' => [
            '__root__' => '`.birthdate` must pass all the rules',
            'date' => '`.birthdate` must be a valid date in the format "2005-12-30"',
            'dateTimeDiffLessThanOrEqual' => 'For comparison with now, `.birthdate` must be a valid datetime',
        ],
        'email' => '`.email` must be a valid email address or must be null',
        'phone' => '`.phone` must be a valid telephone number or must be null',
    ],
));

test('Failed attributes on the class', expectAll(
    fn() => v::attributes()->assert(new WithAttributes('John Doe', '2024-06-23')),
    '`.email` must be defined',
    <<<'FULL_MESSAGE'
    - `Respect\Validation\Test\Stubs\WithAttributes { +$name="John Doe" +$birthdate="2024-06-23" +$email=null +$phone=n ... }` must pass at least one of the rules
      - `.email` must be defined
      - `.phone` must be defined
    FULL_MESSAGE,
    [
        'anyOf' => [
            '__root__' => '`Respect\Validation\Test\Stubs\WithAttributes { +$name="John Doe" +$birthdate="2024-06-23" +$email=null +$phone=n ... }` must pass at least one of the rules',
            'email' => '`.email` must be defined',
            'phone' => '`.phone` must be defined',
        ],
    ],
));

test('Multiple attributes, one failed', expectAll(
    fn() => v::attributes()->assert(new WithAttributes('John Doe', '22 years ago', 'john.doe@gmail.com')),
    '`.birthdate` must be a valid date in the format "2005-12-30"',
    '- `.birthdate` must be a valid date in the format "2005-12-30"',
    ['birthdate' => '`.birthdate` must be a valid date in the format "2005-12-30"'],
));
