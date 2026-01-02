<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

$arr = [
    'name' => 'w',
    'email' => 'hello@hello.com',
];

test('https://github.com/Respect/Validation/issues/446', catchAll(
    fn() => v::init()
        ->key('name', v::lengthBetween(2, 32))
        ->key('email', v::email())
        ->assert($arr),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of `.name` must be between 2 and 32')
        ->and($fullMessage)->toBe('- The length of `.name` must be between 2 and 32')
        ->and($messages)->toBe(['name' => 'The length of `.name` must be between 2 and 32']),
));
