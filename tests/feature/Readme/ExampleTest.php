<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchFullMessage(
    fn() => v::alnum()->notSpaced()->lengthBetween(1, 15)->assert('really messed up screen#name'),
    fn(string $fullMessage) => expect($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "really messed up screen#name" must pass all the rules
          - "really messed up screen#name" must contain only letters (a-z) and digits (0-9)
          - "really messed up screen#name" must not contain whitespaces
          - The length of "really messed up screen#name" must be between 1 and 15
        FULL_MESSAGE),
));
