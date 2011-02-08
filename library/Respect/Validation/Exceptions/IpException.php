<?php

namespace Respect\Validation\Exceptions;

class IpException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s must be an IP address',
    );

}