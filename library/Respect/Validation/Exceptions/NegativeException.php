<?php

namespace Respect\Validation\Exceptions;

class NegativeException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not a negative number',
    );

}