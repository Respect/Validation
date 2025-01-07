<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Rules\Core\Simple;

test('https://github.com/Respect/Validation/issues/1477', expectAll(
    function (): void {
        v::key(
            'Address',
            v::templated(
                new class extends Simple {
                    public function isValid(mixed $input): bool
                    {
                        return false;
                    }
                },
                '{{name}} is not good!',
            ),
        )->assert(['Address' => 'cvejvn']);
    },
    '`.Address` is not good!',
    '- `.Address` is not good!',
    ['Address' => '`.Address` is not good!'],
));
