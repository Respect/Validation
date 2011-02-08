<?php

namespace Respect\Validation\Exceptions;

class LengthException extends BetweenException
{

    public static $defaultTemplates = array(
        self::BOTH => '%s must have a length between %d and %d',
        self::LOWER => '%s must have a length greater than %2$d',
        self::GREATER => '%s must have a length lower than %3$d',
    );

}