<?php

namespace Respect\Validation\Exceptions;

class NegativeException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%d" is not a negative number',
    );

}