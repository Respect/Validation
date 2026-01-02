<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Scenario #1', catchMessages(
    fn() => v::init()
        ->key('username', v::lengthBetween(2, 32))->key('birthdate', v::dateTime())
        ->key('password', v::notBlank())
        ->key('email', v::email())
        ->assert(['username' => 'u', 'birthdate' => 'Not a date', 'password' => '']),
    fn(array $messages) => expect($messages)->toBe([
        '__root__' => '`["username": "u", "birthdate": "Not a date", "password": ""]` must pass all the rules',
        'username' => 'The length of `.username` must be between 2 and 32',
        'birthdate' => '`.birthdate` must be a valid date/time',
        'password' => '`.password` must not be blank',
        'email' => '`.email` must be present',
    ]),
));
