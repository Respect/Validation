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

/**
 * Exception class for Size rule.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class SizeException extends BetweenException
{
    /**
     * @var array
     */
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::BOTH => '{{name}} must be between {{minSize}} and {{maxSize}}',
            self::LOWER => '{{name}} must be greater than {{minSize}}',
            self::GREATER => '{{name}} must be lower than {{maxSize}}',
        ),
        self::MODE_NEGATIVE => array(
            self::BOTH => '{{name}} must not be between {{minSize}} and {{maxSize}}',
            self::LOWER => '{{name}} must not be greater than {{minSize}}',
            self::GREATER => '{{name}} must not be lower than {{maxSize}}',
        ),
    );
}
