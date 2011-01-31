<?php

namespace Respect\Validation\Exceptions;

class ArrException extends ValidationException
{
    public static $defaultTemplates = array(
        '"%s" is not an array',
    );

}