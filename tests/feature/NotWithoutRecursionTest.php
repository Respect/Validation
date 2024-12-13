<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Validator;

test('Scenario #1', expectMessage(
    function (): void {
        $validator = Validator::not(Validator::intVal()->positive());
        $validator->assert(2);
    },
    '2 must not be an integer value',
));
