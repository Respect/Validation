<?php

namespace Respect\Validation\Exceptions;

class InstanceException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be an instance of {{instanceName}}',
    );

}
