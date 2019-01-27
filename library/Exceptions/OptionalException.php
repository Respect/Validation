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

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class OptionalException extends ValidationException
{
    public const NAMED = 'named';

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'The value must be optional',
            self::NAMED => '{{name}} must be optional',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'The value must not be optional',
            self::NAMED => '{{name}} must not be optional',
        ],
    ];

    protected function chooseTemplate(): string
    {
        return $this->getParam('name') ? static::NAMED : static::STANDARD;
    }
}
