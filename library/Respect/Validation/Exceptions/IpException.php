<?php

namespace Respect\Validation\Exceptions;

class IpException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not a valid IP address',
    );

}