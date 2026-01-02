<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Scenario #1', catchFullMessage(
    fn() => v::named(v::create()
        ->key('username', v::length(v::between(2, 32)))
        ->key('birthdate', v::dateTime()), 'User Subscription Form')
        ->assert(['username' => '0', 'birthdate' => 'Whatever']),
    fn(string $fullMessage) => expect($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - User Subscription Form must pass all the rules
          - The length of `.username` must be between 2 and 32
          - `.birthdate` must be a valid date/time
        FULL_MESSAGE),
));
