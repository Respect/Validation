<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\Nullable;
use Respect\Validation\Validatable;

final class NullableException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => 'The value must be nullable',
            Nullable::TEMPLATE_NAMED => '{{name}} must be nullable',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => 'The value must not be null',
            Nullable::TEMPLATE_NAMED => '{{name}} must not be null',
        ],
    ];
}
