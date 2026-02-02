<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1333', catchAll(
    fn() => v::named('User Email', v::notSpaced()->email())->assert('not email'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('User Email must not contain whitespace')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - User Email must pass all the rules
              - "not email" must not contain whitespace
              - "not email" must be an email address
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'User Email must pass all the rules',
            'notSpaced' => '"not email" must not contain whitespace',
            'email' => '"not email" must be an email address',
        ]),
));
