<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

use Respect\Validation\Validator;

test('Scenario #1', expectFullMessage(
    function (): void {
        Validator::create()
            ->key('username', Validator::length(Validator::between(2, 32)))
            ->key('birthdate', Validator::dateTime())
            ->setName('User Subscription Form')
            ->assert(['username' => '0', 'birthdate' => 'Whatever']);
    },
    <<<'FULL_MESSAGE'
    - User Subscription Form must pass all the rules
      - The length of `.username` must be between 2 and 32
      - `.birthdate` must be a valid date/time
    FULL_MESSAGE,
));
