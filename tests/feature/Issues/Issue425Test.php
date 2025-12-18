<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/425', catchAll(
    function (): void {
        $validator = v::create()
            ->key('age', v::intType()->notEmpty()->noneOf(v::stringType(), v::arrayType()))
            ->key('reference', v::stringType()->notEmpty()->lengthBetween(1, 50));
        $validator->assert(['age' => 1]);
    },
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.reference` must be present')
        ->and($fullMessage)->toBe('- `.reference` must be present')
        ->and($messages)->toBe(['reference' => '`.reference` must be present'])
));
