<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\DateTime;
use Respect\Validation\Validatable;

final class DateTimeException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must be a valid date/time',
            DateTime::TEMPLATE_FORMAT => '{{name}} must be a valid date/time in the format {{sample}}',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not be a valid date/time',
            DateTime::TEMPLATE_FORMAT => '{{name}} must not be a valid date/time in the format {{sample}}',
        ],
    ];
}
