<?php

namespace Respect\Validation\Exceptions;

class NullValueException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not a null value',
    );

}