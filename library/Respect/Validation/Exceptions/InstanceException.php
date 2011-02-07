<?php

namespace Respect\Validation\Exceptions;

class InstanceException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '"%s" is not an instance of "%s"',
    );

}