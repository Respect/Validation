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
 * @author Kinn Coelho Juli  o <kinncj@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CharsetException extends ValidationException
{
    /**
     * {@inheritdoc}
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be in the {{charset}} charset',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be in the {{charset}} charset',
        ],
    ];
}
