<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class BetweenException extends NestedValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be between {{minValue}} and {{maxValue}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be between {{minValue}} and {{maxValue}}',
        ],
    ];
}
