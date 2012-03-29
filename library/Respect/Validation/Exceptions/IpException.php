<?php

namespace Respect\Validation\Exceptions;

class IpException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be an IP address',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be an IP address',
        )
    );

}

