<?php

namespace Respect\Validation\Exceptions;

class ZendException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '%s',
    );

}