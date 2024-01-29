<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\AbstractFilterRule;
use Respect\Validation\Validatable;

final class ConsonantException extends FilteredValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must contain only consonants',
            AbstractFilterRule::TEMPLATE_EXTRA => '{{name}} must contain only consonants and {{additionalChars}}',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not contain consonants',
            AbstractFilterRule::TEMPLATE_EXTRA => '{{name}} must not contain consonants or {{additionalChars}}',
        ],
    ];
}
