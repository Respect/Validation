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

class IdenticalException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be identical as {{compareTo}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be identical as {{compareTo}}',
        ),
    );
}
