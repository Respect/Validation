<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/425', expectAll(
    function (): void {
        $validator = v::create()
            ->key('age', v::intType()->notEmpty()->noneOf(v::stringType(), v::arrayType()))
            ->key('reference', v::stringType()->notEmpty()->lengthBetween(1, 50));
        $validator->assert(['age' => 1]);
    },
    'reference must be present',
    '- reference must be present',
    ['reference' => 'reference must be present']
));
