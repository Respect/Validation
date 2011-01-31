<?php

namespace Respect\Validation\Exceptions;

class StringException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not a valid string',
    );

}