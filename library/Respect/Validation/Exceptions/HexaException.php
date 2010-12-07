<?php

namespace Respect\Validation\Exceptions;

class HexaException extends ValidationException
{
    const INVALID_HEXA= 'Hexa_1';
    public static $defaultTemplates = array(
        self::INVALID_HEXA => '"%s" is not a valid hexadecimal number',
    );

}