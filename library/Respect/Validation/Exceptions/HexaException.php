<?php

namespace Respect\Validation\Exceptions;

class HexaException extends ValidationException
{
    public static $defaultTemplates = array(
        '"%s" is not a valid hexadecimal number',
    );

}