<?php

namespace Respect\Validation\Exceptions;

class HexaException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be a hexadecimal number',
    );

}
