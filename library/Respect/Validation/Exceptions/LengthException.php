<?php

namespace Respect\Validation\Exceptions;

class LengthException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" length is not between %d and %d',
        '"%s" length is lower than %2$d',
        '"%s" length is greater than %3$d',
    );

    public function chooseTemplate($input, $min, $max)
    {
        if (is_null($min))
            return 2;
        elseif (is_null($max))
            return 1;
        else
            return 0;
    }

}