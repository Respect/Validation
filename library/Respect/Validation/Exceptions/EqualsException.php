<?php

namespace Respect\Validation\Exceptions;

class EqualsException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not equals "%s"',
        '"%s" is not identical to "%s"',
    );

    public function chooseTemplate($input, $equals, $identical)
    {
        if ($identical)
            return 1;
        else
            return 0;
    }

}