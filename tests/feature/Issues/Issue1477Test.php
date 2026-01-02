<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Rules\Core\Simple;

test('https://github.com/Respect/Validation/issues/1477', catchAll(
    fn() => v::key(
        'Address',
        v::templated(
            '{{subject}} is not good!',
            new class extends Simple {
                public function isValid(mixed $input): bool
                {
                    return false;
                }
            },
        ),
    )->assert(['Address' => 'cvejvn']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.Address` is not good!')
        ->and($fullMessage)->toBe('- `.Address` is not good!')
        ->and($messages)->toBe(['Address' => '`.Address` is not good!']),
));
