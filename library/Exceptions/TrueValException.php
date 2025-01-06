<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * Exceptions thrown by TrueVal rule.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 * @deprecated Using rule exceptions directly is deprecated, and will be removed in the next major version. Please use {@see ValidationException} instead.
 */
final class TrueValException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must evaluate to `true`',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not evaluate to `true`',
        ],
    ];
}
