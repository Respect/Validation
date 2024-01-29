<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\AbstractFilterRule;
use Respect\Validation\Validatable;

final class AlphaException extends FilteredValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must contain only letters (a-z)',
            AbstractFilterRule::TEMPLATE_EXTRA => '{{name}} must contain only letters (a-z) and {{additionalChars}}',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not contain letters (a-z)',
            AbstractFilterRule::TEMPLATE_EXTRA => '{{name}} must not contain letters (a-z) or {{additionalChars}}',
        ],
    ];
}
