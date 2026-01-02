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

test('https://github.com/Respect/Validation/issues/1289', catchAll(
    fn() => Validator::init(
        new Each(
            Validator::init(
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
                'default' => '`.0.default` must be a boolean',
                'description' => '`.0.description` must be a string value',
            ],
        ]),
));
