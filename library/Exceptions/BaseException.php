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
 * @author Carlos André Ferrari <caferrari@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <not.committed.yet>
 */
final class BaseException extends ValidationException
{
    /**
     * {@inheritdoc}
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a number in the base {{base}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a number in the base {{base}}',
        ],
    ];
}
