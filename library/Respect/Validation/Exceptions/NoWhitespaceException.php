<?php

namespace Respect\Validation\Exceptions;

class NoWhitespaceException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" contains whitespace',
    );

}