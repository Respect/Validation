<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessages(
    fn() => v::alnum()->noWhitespace()->lengthBetween(1, 15)->assert('really messed up screen#name'),
    [
        '__root__' => '"really messed up screen#name" must pass all the rules',
        'alnum' => '"really messed up screen#name" must contain only letters (a-z) and digits (0-9)',
        'noWhitespace' => '"really messed up screen#name" must not contain whitespaces',
        'lengthBetween' => 'The length of "really messed up screen#name" must be between 1 and 15',
    ],
));
