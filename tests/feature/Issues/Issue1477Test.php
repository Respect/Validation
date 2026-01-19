<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\Validators\Core\Simple;

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
