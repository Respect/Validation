<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * Exception class for BoolType rule.
 *
 * @author Devin Torres <devin@devintorres.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BoolTypeException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be of type boolean',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be of type boolean',
        ],
    ];
}
