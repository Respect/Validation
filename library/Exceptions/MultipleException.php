<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class MultipleException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be multiple of {{multipleOf}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be multiple of {{multipleOf}}',
        ],
    ];
}
