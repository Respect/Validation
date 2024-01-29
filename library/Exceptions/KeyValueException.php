<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\KeyValue;
use Respect\Validation\Validatable;

final class KeyValueException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => 'Key {{name}} must be present',
            KeyValue::TEMPLATE_COMPONENT => '{{baseKey}} must be valid to validate {{comparedKey}}',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => 'Key {{name}} must not be present',
            KeyValue::TEMPLATE_COMPONENT => '{{baseKey}} must not be valid to validate {{comparedKey}}',
        ],
    ];
}
