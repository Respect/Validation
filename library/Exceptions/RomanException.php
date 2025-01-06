<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @deprecated Using rule exceptions directly is deprecated, and will be removed in the next major version. Please use {@see ValidationException} instead.
 */
final class RomanException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid Roman numeral',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid Roman numeral',
        ],
    ];
}
