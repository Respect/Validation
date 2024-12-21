<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Test\Stubs\WithAttributes;

test('Default', expectAll(
    fn() => v::attributes()->assert(new WithAttributes('', 'john.doe@gmail.com', '2024-06-23')),
    '`.name` must not be empty',
    '- `.name` must not be empty',
    ['name' => '`.name` must not be empty'],
));

test('Inverted', expectAll(
    fn() => v::attributes()->assert(new WithAttributes('John Doe', 'john.doe@gmail.com', '2024-06-23', '+1234567890')),
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
    fn() => v::attributes()->assert(new WithAttributes('John Doe', 'john.doe@gmail.com', '2024-06-23', 'not a phone number')),
    '`.phone` must be a valid telephone number or must be null',
    '- `.phone` must be a valid telephone number or must be null',
    ['phone' => '`.phone` must be a valid telephone number or must be null'],
));

test('Multiple attributes, all failed', expectAll(
    fn() => v::attributes()->assert(new WithAttributes('', 'not an email', 'not a date', 'not a phone number')),
    '`.name` must not be empty',
    <<<'FULL_MESSAGE'
    - `Respect\Validation\Test\Stubs\WithAttributes { +$name="" +$email="not an email" +$birthdate="not a date" +$phone ... }` must pass all the rules
      - `.name` must not be empty
      - `.email` must be a valid email address
      - `.birthdate` must pass all the rules
        - `.birthdate` must be a valid date in the format "2005-12-30"
        - For comparison with now, `.birthdate` must be a valid datetime
      - `.phone` must be a valid telephone number or must be null
    FULL_MESSAGE,
    [
        '__root__' => '`Respect\Validation\Test\Stubs\WithAttributes{ +$name="" +$email="not an email" +$birthdate="not a date" +$phone ... }` must pass all the rules',
        'name' => '`.name` must not be empty',
        'email' => '`.email` must be a valid email address',
        'birthdate' => [
            '__root__' => 'birthdate must pass all the rules',
            'date' => '`.birthdate` must be a valid date in the format "2005-12-30"',
            'dateTimeDiffLessThanOrEqual' => 'For comparison with now, `.birthdate` must be a valid datetime',
        ],
        'phone' => '`.phone` must be a valid telephone number or must be null',
    ],
));

test('Multiple attributes, one failed', expectAll(
    fn() => v::attributes()->assert(new WithAttributes('John Doe', 'john.doe@gmail.com', '22 years ago')),
    '`.birthdate` must be a valid date in the format "2005-12-30"',
    '- `.birthdate` must be a valid date in the format "2005-12-30"',
    ['birthdate' => '`.birthdate` must be a valid date in the format "2005-12-30"'],
));
