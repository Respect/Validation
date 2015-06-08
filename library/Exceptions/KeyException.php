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

class KeyException extends AttributeException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::NOT_PRESENT => 'Key {{name}} must be present',
            self::INVALID => 'Key {{name}} must be valid',
        ),
        self::MODE_NEGATIVE => array(
            self::NOT_PRESENT => 'Key {{name}} must not be present',
            self::INVALID => 'Key {{name}} must not be valid',
        ),
    );
}
