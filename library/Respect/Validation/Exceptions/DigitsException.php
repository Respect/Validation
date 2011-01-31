<?php

namespace Respect\Validation\Exceptions;

class DigitsException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" does not contain only digits',
    );

}