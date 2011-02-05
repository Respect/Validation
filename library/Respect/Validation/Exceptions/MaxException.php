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
        return $inclusive ? 0 : 1 ;
    }

}