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

class AgeException extends NestedValidationException
{
    const BOTH = 0;
    const LOWER = 1;
    const GREATER = 2;

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::BOTH => '{{name}} must be between {{minAge}} and {{maxAge}} years ago',
            self::LOWER => '{{name}} must be lower than {{minAge}} years ago',
            self::GREATER => '{{name}} must be greater than {{maxAge}} years ago',
        ],
        self::MODE_NEGATIVE => [
            self::BOTH => '{{name}} must not be between {{minAge}} and {{maxAge}} years ago',
            self::LOWER => '{{name}} must not be lower than {{minAge}} years ago',
            self::GREATER => '{{name}} must not be greater than {{maxAge}} years ago',
        ],
    ];

    public function chooseTemplate()
    {
        if (!$this->getParam('minAge')) {
            return static::GREATER;
        }

        if (!$this->getParam('maxAge')) {
            return static::LOWER;
        }

        return static::BOTH;
    }
}
