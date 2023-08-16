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
 * @author Ian Nisbet <ian@glutenite.co.uk>
 */
final class EqualsException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must equal {{compareTo}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not equal {{compareTo}}',
        ],
    ];
}
