<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessages(
    fn() => v::alnum()
        ->noWhitespace()
        ->length(v::between(1, 15))
        ->assert('really messed up screen#name', [
            'alnum' => '{{name}} must contain only letters and digits',
            'noWhitespace' => '{{name}} cannot contain spaces',
            'length' => '{{name}} must not have more than 15 chars',
        ]),
    [
        '__root__' => '"really messed up screen#name" must pass all the rules',
        'alnum' => '"really messed up screen#name" must contain only letters and digits',
        'noWhitespace' => '"really messed up screen#name" cannot contain spaces',
        'lengthBetween' => 'The length of "really messed up screen#name" must be between 1 and 15',
    ],
));
