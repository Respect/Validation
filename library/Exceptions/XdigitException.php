<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\AbstractFilterRule;
use Respect\Validation\Validatable;

final class XdigitException extends FilteredValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} contain only hexadecimal digits',
            AbstractFilterRule::TEMPLATE_EXTRA => '{{name}} contain only hexadecimal digits and {{additionalChars}}',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not contain hexadecimal digits',
            AbstractFilterRule::TEMPLATE_EXTRA => '{{name}} must not contain hexadecimal digits or {{additionalChars}}',
        ],
    ];
}
