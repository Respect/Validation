<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * Exceptions to be thrown by the Printable Rule.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class PrintableException extends FilteredValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must contain only printable characters',
            self::EXTRA => '{{name}} must contain only printable characters and "{{additionalChars}}"',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not contain printable characters',
            self::EXTRA => '{{name}} must not contain printable characters or "{{additionalChars}}"',
        ],
    ];
}
