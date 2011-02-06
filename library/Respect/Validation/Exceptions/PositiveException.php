<?php

namespace Respect\Validation\Exceptions;

class PositiveException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not a positive number',
    );

}