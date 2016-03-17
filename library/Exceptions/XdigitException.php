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

class XdigitException extends AlphaException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} contain only hexadecimal digits',
            self::EXTRA => '{{name}} contain only hexadecimal digits and "{{additionalChars}}"',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not contain hexadecimal digits',
            self::EXTRA => '{{name}} must not contain hexadecimal digits or "{{additionalChars}}"',
        ],
    ];
}
