<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Exceptions;

class AlnumException extends AlphaException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must contain only letters (a-z) and digits (0-9)',
            self::EXTRA => '{{name}} must contain only letters (a-z), digits (0-9) and {{additionalChars}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not contain letters (a-z) or digits (0-9)',
            self::EXTRA => '{{name}} must not contain letters (a-z), digits (0-9) or {{additionalChars}}',
        ],
    ];
}
