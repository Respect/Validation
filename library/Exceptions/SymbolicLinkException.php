<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Gus Antoniassi <gus.antoniassi@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SymbolicLinkException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a symbolic link',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a symbolic link',
        ],
    ];
}
