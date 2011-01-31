<?php

namespace Respect\Validation\Exceptions;

class MaxException extends ValidationException
{

    public static $defaultTemplates = array(
        '%s is greater than %s',
        '%s is greater than %s (inclusive)',
    );

    public function chooseTemplate($input, $inclusive)
    {
        if ($inclusive)
            return 0;
        else
            return 1;
    }

}