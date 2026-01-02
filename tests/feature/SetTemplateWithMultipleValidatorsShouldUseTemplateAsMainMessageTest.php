<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Validator;

test('Scenario #1', catchMessage(function (): void {
    v::templated('{{subject}} is not tasty', Validator::callback('is_int')->between(1, 2))->assert('something');
},
fn(string $message) => expect($message)->toBe('"something" is not tasty')));
