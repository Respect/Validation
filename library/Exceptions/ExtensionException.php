<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Validatable;

final class ExtensionException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must have {{extension}} extension',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not have {{extension}} extension',
        ],
    ];
}
