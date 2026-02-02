<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessages(
    fn() => v::alnum()->notSpaced()->lengthBetween(1, 15)->assert('really messed up screen#name'),
    fn(array $messages) => expect($messages)->toBe([
        '__root__' => '"really messed up screen#name" must pass all the rules',
        'alnum' => '"really messed up screen#name" must consist only of letters (a-z) and digits (0-9)',
        'notSpaced' => '"really messed up screen#name" must not contain whitespace',
        'lengthBetween' => 'The length of "really messed up screen#name" must be between 1 and 15',
    ]),
));
