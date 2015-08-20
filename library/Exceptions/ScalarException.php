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
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class ScalarException extends ValidationException
{
    /**
     * @var array
     */
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a scalar value',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a scalar value',
        ),
    );
}
