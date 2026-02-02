<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\ValidatorBuilder;

test('Scenario #1', catchMessage(
    fn() => ValidatorBuilder::alnum('__')->lengthBetween(1, 15)->notSpaced()->assert('really messed up screen#name'),
    fn(string $message) => expect($message)->toBe('"really messed up screen#name" must consist only of letters (a-z), digits (0-9), or "__"'),
));
