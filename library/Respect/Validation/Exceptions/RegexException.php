<?php

namespace Respect\Validation\Exceptions;

class RegexException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must validate against {{regex}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not validate against {{regex}}',
        )
    );

}

