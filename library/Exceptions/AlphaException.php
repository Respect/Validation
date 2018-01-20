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

class AlphaException extends ValidationException
{
    const EXTRA = 1;

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must contain only letters (a-z)',
            self::EXTRA => '{{name}} must contain only letters (a-z) and "{{additionalChars}}"',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not contain letters (a-z)',
            self::EXTRA => '{{name}} must not contain letters (a-z) or "{{additionalChars}}"',
        ],
    ];

    public function chooseTemplate()
    {
        return $this->getParam('additionalChars') ? static::EXTRA : static::STANDARD;
    }
}
