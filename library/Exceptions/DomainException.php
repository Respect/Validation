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
final class DomainException extends NestedValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid domain',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid domain',
        ],
    ];
}
