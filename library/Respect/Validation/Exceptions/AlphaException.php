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
        return empty($additionalCharacters) ? 0 : 1;
    }

}