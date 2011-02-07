<?php

namespace Respect\Validation\Exceptions;

class AlnumException extends AlphaException
{

    public static $defaultTemplates = array(
        self::STANDARD => '"%s" does not contain only letters and digits',
        self::EXTRA => '"%s" does not contain only letters, digits and "%s"'
    );

}