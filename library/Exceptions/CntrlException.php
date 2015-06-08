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

class CntrlException extends AlphaException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must contain only control characters',
            self::EXTRA => '{{name}} must contain only control characters and "{{additionalChars}}"',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not contain control characters',
            self::EXTRA => '{{name}} must not contain control characters or "{{additionalChars}}"',
        ),
    );
}
