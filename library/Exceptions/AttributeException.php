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

class AttributeException extends NestedValidationException
{
    const NOT_PRESENT = 0;
    const INVALID = 1;
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NOT_PRESENT => 'Attribute {{name}} must be present',
            self::INVALID => 'Attribute {{name}} must be valid',
        ],
        self::MODE_NEGATIVE => [
            self::NOT_PRESENT => 'Attribute {{name}} must not be present',
            self::INVALID => 'Attribute {{name}} must not validate',
        ],
    ];

    public function chooseTemplate()
    {
        return $this->getParam('hasReference') ? static::INVALID : static::NOT_PRESENT;
    }
}
