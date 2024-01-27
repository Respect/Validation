<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class AlwaysInvalidException extends ValidationException
{
    public const SIMPLE = 'simple';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} is always invalid',
            self::SIMPLE => '{{name}} is not valid',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} is always valid',
            self::SIMPLE => '{{name}} is valid',
        ],
    ];
}
