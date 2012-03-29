<?php

namespace Respect\Validation\Exceptions;

class HexaException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a hexadecimal number',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a hexadecimal number',
        )
    );

}

