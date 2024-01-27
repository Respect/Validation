<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class MultipleException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be multiple of {{multipleOf}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be multiple of {{multipleOf}}',
        ],
    ];
}
