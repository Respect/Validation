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
        return $inclusive ? 0: 1;
    }

}