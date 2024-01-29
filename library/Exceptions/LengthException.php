<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\Length;

final class LengthException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Length::TEMPLATE_BOTH => '{{name}} must have a length between {{minValue}} and {{maxValue}}',
            Length::TEMPLATE_LOWER => '{{name}} must have a length greater than {{minValue}}',
            Length::TEMPLATE_LOWER_INCLUSIVE => '{{name}} must have a length greater than or equal to {{minValue}}',
            Length::TEMPLATE_GREATER => '{{name}} must have a length lower than {{maxValue}}',
            Length::TEMPLATE_GREATER_INCLUSIVE => '{{name}} must have a length lower than or equal to {{maxValue}}',
            Length::TEMPLATE_EXACT => '{{name}} must have a length of {{maxValue}}',
        ],
        self::MODE_NEGATIVE => [
            Length::TEMPLATE_BOTH => '{{name}} must not have a length between {{minValue}} and {{maxValue}}',
            Length::TEMPLATE_LOWER => '{{name}} must not have a length greater than {{minValue}}',
            Length::TEMPLATE_LOWER_INCLUSIVE => '{{name}} must not have a length greater than or equal to {{minValue}}',
            Length::TEMPLATE_GREATER => '{{name}} must not have a length lower than {{maxValue}}',
            Length::TEMPLATE_GREATER_INCLUSIVE => '{{name}} must not have a length lower than or equal to {{maxValue}}',
            Length::TEMPLATE_EXACT => '{{name}} must not have a length of {{maxValue}}',
        ],
    ];
}
