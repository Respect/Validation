<?php

namespace Respect\Validation\Exceptions;

class LengthException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" length is not between %d and %d',
    );

}