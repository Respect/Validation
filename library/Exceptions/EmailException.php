<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * Exceptions thrown by email rule.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Andrey Kolyshkin <a.kolyshkin@semrush.com>
 * @author Eduardo Gulias Davis <me@egulias.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 * @deprecated Using rule exceptions directly is deprecated, and will be removed in the next major version. Please use {@see ValidationException} instead.
 */
final class EmailException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be valid email',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be an email',
        ],
    ];
}
