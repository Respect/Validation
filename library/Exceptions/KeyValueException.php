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

class KeyValueException extends ValidationException
{
    const COMPONENT = 1;

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Key {{name}} must be present',
            self::COMPONENT => '{{baseKey}} must be valid to validate {{comparedKey}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Key {{name}} must not be present',
            self::COMPONENT => '{{baseKey}} must not be valid to validate {{comparedKey}}',
        ],
    ];

    public function chooseTemplate()
    {
        return $this->getParam('component') ? static::COMPONENT : static::STANDARD;
    }
}
