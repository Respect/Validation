<?php

namespace Respect\Validation\Exceptions;

class ContainsException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must contain the value "{{containsValue}}"',
    );

}
