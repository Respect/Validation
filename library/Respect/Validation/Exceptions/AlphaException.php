<?php

namespace Respect\Validation\Exceptions;

class AlphaException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" does not contain only letters',
        '"%s" does not contain only letters and "%s"'
    );

    public function chooseTemplate($input, $additionalCharacters=null)
    {
        if (empty($additionalCharacters))
            return 0;
        else
            return 1;
    }

}