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

class MaxException extends ValidationException
{
    const INCLUSIVE = 1;

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be lower than {{interval}}',
            self::INCLUSIVE => '{{name}} must be lower than or equals {{interval}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be lower than {{interval}}',
            self::INCLUSIVE => '{{name}} must not be lower than or equals {{interval}}',
        ],
    ];

    public function chooseTemplate()
    {
        return $this->getParam('inclusive') ? static::INCLUSIVE : static::STANDARD;
    }
}
