<?php

namespace Respect\Validation\Exceptions;

class MinException extends ValidationException
{

    public static $defaultTemplates = array(
        '%s is lower than %s',
        '%s is lower than %s (inclusive)',
    );

    public function chooseTemplate($input, $inclusive)
    {
        if ($inclusive)
            return 0;
        else
            return 1;
    }

}