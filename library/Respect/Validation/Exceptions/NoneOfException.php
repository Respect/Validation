<?php

namespace Respect\Validation\Exceptions;

class NoneOfException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => 'None of these rules must pass for %1$s',
    );

}