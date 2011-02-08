<?php

namespace Respect\Validation\Exceptions;

class HexaException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be a hexadecimal number',
    );

}