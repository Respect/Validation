<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1333', expectAll(
    fn() => v::noWhitespace()->email()->setName('User Email')->assert('not email'),
    'User Email must not contain whitespaces',
    <<<'FULL_MESSAGE'
    - All of the required rules must pass for User Email
      - User Email must not contain whitespaces
      - User Email must be a valid email address
    FULL_MESSAGE,
    [
        '__root__' => 'All of the required rules must pass for User Email',
        'noWhitespace' => 'User Email must not contain whitespaces',
        'email' => 'User Email must be a valid email address',
    ]
));
