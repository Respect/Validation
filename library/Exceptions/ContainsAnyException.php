<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Kirill Dlussky <kirill@dlussky.ru>
 */
final class ContainsAnyException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must contain at least one of the values {{needles}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not contain any of the values {{needles}}',
        ],
    ];
}
