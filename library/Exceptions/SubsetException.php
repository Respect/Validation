<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Singwai Chan <singwai.chan@live.com>
 */
final class SubsetException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be subset of {{superset}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be subset of {{superset}}',
        ],
    ];
}
