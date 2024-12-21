<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Rules\ArrayType;
use Respect\Validation\Rules\BoolType;
use Respect\Validation\Rules\Each;
use Respect\Validation\Rules\KeyOptional;
use Respect\Validation\Rules\OneOf;
use Respect\Validation\Rules\StringType;
use Respect\Validation\Rules\StringVal;
use Respect\Validation\Validator;

test('https://github.com/Respect/Validation/issues/1289', expectAll(
    fn() => Validator::create(
        new Each(
            Validator::create(
                new KeyOptional(
                    'default',
                    new OneOf(
                        new StringType(),
                        new BoolType(),
                    ),
                ),
                new KeyOptional(
                    'description',
                    new StringVal(),
                ),
                new KeyOptional(
                    'children',
                    new ArrayType(),
                ),
            ),
        ),
    )
        ->assert([
            [
                'default' => 2,
                'description' => [],
                'children' => ['nope'],
            ],
        ]),
    '`.0.default` must be a string',
    <<<'FULL_MESSAGE'
    - `.0` must pass the rules
      - `.default` must pass one of the rules
        - 2 must be a string
        - 2 must be a boolean
      - `.description` must be a string value
    FULL_MESSAGE,
    [
        0 => [
            '__root__' => '`.0` must pass the rules',
            'default' => [
                '__root__' => '`.default` must pass one of the rules',
                'stringType' => '2 must be a string',
                'boolType' => '2 must be a boolean',
            ],
            'description' => '`.description` must be a string value',
        ],
    ],
));
