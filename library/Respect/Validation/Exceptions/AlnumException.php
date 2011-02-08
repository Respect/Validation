<?php

namespace Respect\Validation\Exceptions;

class AlnumException extends AlphaException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must contain only letters (a-z) and digits (0-9)',
        self::EXTRA => '%s must contain only letters (a-z), digits (0-9) and "%s"'
    );

}