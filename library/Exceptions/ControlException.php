<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ControlException extends FilteredValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must contain only control characters',
            self::EXTRA => '{{name}} must contain only control characters and {{additionalChars}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not contain control characters',
            self::EXTRA => '{{name}} must not contain control characters or {{additionalChars}}',
        ],
    ];
}
