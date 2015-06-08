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

class EqualsException extends ValidationException
{
    const EQUALS = 0;
    const IDENTICAL = 1;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::EQUALS => '{{name}} must be equals {{compareTo}}',
            self::IDENTICAL => '{{name}} must be identical as {{compareTo}}',
        ),
        self::MODE_NEGATIVE => array(
            self::EQUALS => '{{name}} must not be equals {{compareTo}}',
            self::IDENTICAL => '{{name}} must not be identical as {{compareTo}}',
        ),
    );

    public function chooseTemplate()
    {
        return $this->getParam('identical') ? static::IDENTICAL : static::EQUALS;
    }
}
