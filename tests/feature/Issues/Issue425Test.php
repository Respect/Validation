<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/425', catchAll(
    function (): void {
        $validator = v::init()
            ->key('age', v::intType()->notBlank()->noneOf(v::stringType(), v::arrayType()))
            ->key('reference', v::stringType()->notBlank()->lengthBetween(1, 50));
        $validator->assert(['age' => 1]);
    },
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.reference` must be present')
        ->and($fullMessage)->toBe('- `.reference` must be present')
        ->and($messages)->toBe(['reference' => '`.reference` must be present']),
));
