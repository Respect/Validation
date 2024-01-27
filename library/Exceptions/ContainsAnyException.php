<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class ContainsAnyException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must contain at least one of the values {{needles}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not contain any of the values {{needles}}',
        ],
    ];
}
