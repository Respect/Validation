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

class KeyNestedException extends AttributeException implements NonOmissibleExceptionInterface
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NOT_PRESENT => 'No items were found for key chain {{name}}',
            self::INVALID => 'Key chain {{name}} is not valid',
        ],
        self::MODE_NEGATIVE => [
            self::NOT_PRESENT => 'Items for key chain {{name}} must not be present',
            self::INVALID => 'Key chain {{name}} must not be valid',
        ],
    ];
}
