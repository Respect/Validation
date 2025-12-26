<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Validator;

test('Scenario', catchMessage(
    fn() => Validator::callback('is_int')->setTemplate('{{subject}} is not tasty')->assert('something'),
    fn(string $message) => expect($message)->toBe('"something" is not tasty'),
));
