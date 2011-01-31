<?php

namespace Respect\Validation\Exceptions;

class NumericException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not a numeric value',
    );

}