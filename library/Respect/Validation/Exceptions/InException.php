<?php

namespace Respect\Validation\Exceptions;

class InException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '"%s" is not in %s',
    );

}