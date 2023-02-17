<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class DigitException extends FilteredValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must contain only digits (0-9)',
            self::EXTRA => '{{name}} must contain only digits (0-9) and {{additionalChars}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not contain digits (0-9)',
            self::EXTRA => '{{name}} must not contain digits (0-9) and {{additionalChars}}',
        ],
    ];
}
