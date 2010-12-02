<?php

namespace Respect\Validation\Exceptions;

class IpException extends ValidationException
{
    const INVALID_IP= 'Ip_1';
    public static $defaultTemplates = array(
        self::INVALID_IP => '"%s" is not a valid IP address',
    );

}