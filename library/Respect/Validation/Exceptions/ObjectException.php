<?php

namespace Respect\Validation\Exceptions;

class ObjectException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be an object',
    );

}
