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

test('https://github.com/Respect/Validation/issues/446', expectAll(
    fn() => v::create()
        ->key('name', v::lengthBetween(2, 32))
        ->key('email', v::email())
        ->assert($arr),
    'The length of name must be between 2 and 32',
    '- The length of name must be between 2 and 32',
    ['name' => 'The length of name must be between 2 and 32']
));
