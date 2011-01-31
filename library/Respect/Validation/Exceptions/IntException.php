<?php

namespace Respect\Validation\Exceptions;

class IntException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not a valid integer number',
    );

}