<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Moritz Fromm <moritzgitfromm@gmail.com>
 */
final class IsbnException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a ISBN',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a ISBN',
        ],
    ];
}
