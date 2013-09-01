<?php
namespace Respect\Validation\Exceptions;

class HostnameException extends AbstractNestedException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a valid fully qualified hostname',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid fully qualified hostname',
        )
    );
}

