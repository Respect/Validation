<?php

namespace Respect\Validation\Exceptions;

class FloatException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not a valid float',
    );

}