<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\ValidatorBuilder;
use Respect\Validation\Validators\ArrayType;
use Respect\Validation\Validators\BoolType;
use Respect\Validation\Validators\Each;
use Respect\Validation\Validators\KeyOptional;
use Respect\Validation\Validators\OneOf;
use Respect\Validation\Validators\StringType;
use Respect\Validation\Validators\StringVal;

test('https://github.com/Respect/Validation/issues/1289', catchAll(
    fn() => ValidatorBuilder::init(
        new Each(
            ValidatorBuilder::init(
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
    fn(string $message, string $fullMessage, array $messages) => expect()
        // Currently we're getting `.0.default.default` instead of `.0.default`
        // that is happening the result has multiple children, and they're not inheriting the path from their
        // parent, but instead, the parent is duplicating the children's path.
        ->and($message)->toBe('`.0.default` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - `.0` must pass the rules
              - `.0.default` must pass one of the rules
                - `.0.default` must be a string
                - `.0.default` must be a boolean
              - `.0.description` must be a string value
            FULL_MESSAGE)
        ->and($messages)->toBe([
            0 => [
                '__root__' => '`.0` must pass the rules',
                'default' => [
                    '__root__' => '`.0.default` must pass one of the rules',
                    0 => '`.0.default` must be a string',
                    1 => '`.0.default` must be a boolean',
                ],
                'description' => '`.0.description` must be a string value',
            ],
        ]),
));
