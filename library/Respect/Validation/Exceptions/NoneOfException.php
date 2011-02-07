<?php

namespace Respect\Validation\Exceptions;

class NoneOfException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => 'None of the %4$d rules must pass. %2$d passed',
    );

}