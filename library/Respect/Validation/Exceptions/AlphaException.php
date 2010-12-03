<?php

namespace Respect\Validation\Exceptions;

class AlphaException extends ValidationException
{
    const INVALID_ALPHA = 'Alpha_1';
    const INVALID_ALPHA_CHARS = 'Alpha_2';
    public static $defaultTemplates = array(
        self::INVALID_ALPHA => '"%s" does not contain only letters',
        self::INVALID_ALPHA_CHARS => '"%s" does not contain only letters and "%s"'
    );

    public function chooseTemplate($input, $additionalCharacters=null)
    {
        if (empty($additionalCharacters))
            return self::INVALID_ALPHA;
        else
            return self::INVALID_ALPHA_CHARS;
    }

}