<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Validator;

test('Scenario', catchMessage(
    fn() => v::templated(Validator::callback('is_int'), '{{subject}} is not tasty')->assert('something'),
    fn(string $message) => expect($message)->toBe('"something" is not tasty'),
));
