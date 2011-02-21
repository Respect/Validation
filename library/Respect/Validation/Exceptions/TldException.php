<?php

namespace Respect\Validation\Exceptions;

class TldException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be a valid top-level domain name',
    );

}
