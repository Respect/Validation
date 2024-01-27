<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class FactorException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a factor of {{dividend}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a factor of {{dividend}}',
        ],
    ];
}
