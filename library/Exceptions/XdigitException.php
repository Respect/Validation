<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class XdigitException extends FilteredValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} contain only hexadecimal digits',
            self::EXTRA => '{{name}} contain only hexadecimal digits and {{additionalChars}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not contain hexadecimal digits',
            self::EXTRA => '{{name}} must not contain hexadecimal digits or {{additionalChars}}',
        ],
    ];
}
