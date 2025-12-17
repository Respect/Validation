<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Validator;

test('Scenario #1', catchMessage(
    fn() => Validator::alnum('__')->lengthBetween(1, 15)->noWhitespace()->assert('really messed up screen#name'),
    fn(string $message) => expect($message)->toBe('"really messed up screen#name" must contain only letters (a-z), digits (0-9), and "__"'),
));
