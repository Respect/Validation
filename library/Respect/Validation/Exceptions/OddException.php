<?php

namespace Respect\Validation\Exceptions;

class OddException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be an odd number',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be an odd number',
        )
    );

}
