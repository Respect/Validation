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
 * Exception class for Mimetype rule.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class MimetypeException extends ValidationException
{
    /**
     * @var array
     */
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must have "{{mimetype}}" mimetype',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not have "{{mimetype}}" mimetype',
        ),
    );
}
