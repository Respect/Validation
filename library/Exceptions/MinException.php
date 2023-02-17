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
final class MinException extends ValidationException
{
    public const INCLUSIVE = 'inclusive';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be greater than or equal to {{compareTo}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be greater than or equal to {{compareTo}}',
        ],
    ];
}
