<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Validatable;

final class DecimalException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must have {{decimals}} decimals',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not have {{decimals}} decimals',
        ],
    ];
}
