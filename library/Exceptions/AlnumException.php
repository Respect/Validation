<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\AbstractFilterRule as Filter;
use Respect\Validation\Validatable;

final class AlnumException extends FilteredValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must contain only letters (a-z) and digits (0-9)',
            Filter::TEMPLATE_EXTRA => '{{name}} must contain only letters (a-z), digits (0-9) and {{additionalChars}}',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not contain letters (a-z) or digits (0-9)',
            Filter::TEMPLATE_EXTRA => '{{name}} must not contain letters (a-z), digits (0-9) or {{additionalChars}}',
        ],
    ];
}
