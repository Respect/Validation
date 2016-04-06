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

class CreditCardException extends ValidationException
{
    const BRANDED = 1;

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid Credit Card number',
            self::BRANDED => '{{name}} must be a valid {{brand}} Credit Card number',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid Credit Card number',
            self::BRANDED => '{{name}} must not be a valid {{brand}} Credit Card number',
        ],
    ];

    public function chooseTemplate()
    {
        if (!$this->getParam('brand')) {
            return static::STANDARD;
        }

        return static::BRANDED;
    }
}
