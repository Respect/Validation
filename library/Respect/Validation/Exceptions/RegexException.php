<?php

namespace Respect\Validation\Exceptions;

class RegexException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is invalid',
    );

}