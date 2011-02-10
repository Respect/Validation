<?php

namespace Respect\Validation\Exceptions;

class NullValueException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be null',
    );

}
