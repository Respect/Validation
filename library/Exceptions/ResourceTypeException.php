<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * Exception class for ResourceType.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ResourceTypeException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a resource',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a resource',
        ],
    ];
}
