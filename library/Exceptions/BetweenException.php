<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

class BetweenException extends NestedValidationException
{
    const BOTH = 0;
    const LOWER = 1;
    const GREATER = 2;

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::BOTH => '{{name}} must be between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}}  must be greater than {{minValue}}',
            self::GREATER => '{{name}} must be lower than {{maxValue}}',
        ],
        self::MODE_NEGATIVE => [
            self::BOTH => '{{name}} must not be between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}}  must not be greater than {{minValue}}',
            self::GREATER => '{{name}} must not be lower than {{maxValue}}',
        ],
    ];

    public function chooseTemplate()
    {
        if (!$this->getParam('minValue')) {
            return static::GREATER;
        } elseif (!$this->getParam('maxValue')) {
            return static::LOWER;
        }

        return static::BOTH;
    }
}
