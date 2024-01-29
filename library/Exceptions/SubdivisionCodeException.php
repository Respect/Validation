<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Validatable;

class SubdivisionCodeException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must be a subdivision code of {{countryName}}',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not be a subdivision code of {{countryName}}',
        ],
    ];
}
