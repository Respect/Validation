<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\Uuid;
use Respect\Validation\Validatable;

final class UuidException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must be a valid UUID',
            Uuid::TEMPLATE_VERSION => '{{name}} must be a valid UUID version {{version}}',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not be a valid UUID',
            Uuid::TEMPLATE_VERSION => '{{name}} must not be a valid UUID version {{version}}',
        ],
    ];
}
