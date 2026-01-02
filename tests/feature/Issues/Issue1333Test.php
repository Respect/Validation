<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1333', catchAll(
    fn() => v::named(v::notSpaced()->email(), 'User Email')->assert('not email'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('User Email must not contain whitespaces')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - User Email must pass all the rules
              - "not email" must not contain whitespaces
              - "not email" must be a valid email address
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'User Email must pass all the rules',
            'notSpaced' => '"not email" must not contain whitespaces',
            'email' => '"not email" must be a valid email address',
        ]),
));
