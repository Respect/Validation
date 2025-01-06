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
 * @author William Espindola <oi@williamespindola.com.br>
 * @deprecated Using rule exceptions directly is deprecated, and will be removed in the next major version. Please use {@see ValidationException} instead.
 */
final class AlwaysInvalidException extends ValidationException
{
    public const SIMPLE = 'simple';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} is always invalid',
            self::SIMPLE => '{{name}} is not valid',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} is always valid',
            self::SIMPLE => '{{name}} is valid',
        ],
    ];
}
