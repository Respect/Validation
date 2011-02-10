<?php

namespace Respect\Validation\Exceptions;

class IpException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be an IP address',
    );

}
