<?php

namespace Respect\Validation\Exceptions;

class RegexException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must validate against {{regex}}',
    );

}
