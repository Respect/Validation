<?php

namespace Respect\Validation\Exceptions;

class AlnumException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" does not contain only letters and digits',
        '"%s" does not contain only letters, digits and "%s"'
    );

    public function chooseTemplate($input, $additionalCharacters=null)
    {
        if (empty($additionalCharacters))
            return 0;
        else
            return 1;
    }

}