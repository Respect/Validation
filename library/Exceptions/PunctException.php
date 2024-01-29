<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\AbstractFilterRule as Filter;
use Respect\Validation\Validatable;

final class PunctException extends FilteredValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must contain only punctuation characters',
            Filter::TEMPLATE_EXTRA => '{{name}} must contain only punctuation characters and {{additionalChars}}',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not contain punctuation characters',
            Filter::TEMPLATE_EXTRA => '{{name}} must not contain punctuation characters or {{additionalChars}}',
        ],
    ];
}
