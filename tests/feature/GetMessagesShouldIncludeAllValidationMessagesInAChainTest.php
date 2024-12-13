<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Validator;

date_default_timezone_set('UTC');

test('Scenario #1', expectMessages(
    function (): void {
        Validator::create()
            ->key('username', Validator::lengthBetween(2, 32))->key('birthdate', Validator::dateTime())
            ->key('password', Validator::notEmpty())
            ->key('email', Validator::email())
            ->assert(['username' => 'u', 'birthdate' => 'Not a date', 'password' => '']);
    },
    [
        '__root__' => 'All of the required rules must pass for `["username": "u", "birthdate": "Not a date", "password": ""]`',
        'username' => 'The length of username must be between 2 and 32',
        'birthdate' => 'birthdate must be a valid date/time',
        'password' => 'password must not be empty',
        'email' => 'email must be present',
    ],
));
