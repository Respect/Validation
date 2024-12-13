<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Validator;

test('Scenario #1', expectMessage(
    fn() => Validator::alnum('__')->lengthBetween(1, 15)->noWhitespace()->assert('really messed up screen#name'),
    '"really messed up screen#name" must contain only letters (a-z), digits (0-9), and "__"',
));
