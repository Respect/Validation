<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class OneOfException extends NestedValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Only one of these rules must pass for {{name}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Only one of these rules must not pass for {{name}}',
        ],
    ];
}
