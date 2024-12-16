<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Validator;

test('Scenario', expectMessage(
    fn() =>  Validator::callback('is_int')->setTemplate('{{name}} is not tasty')->assert('something'),
    '"something" is not tasty',
));
