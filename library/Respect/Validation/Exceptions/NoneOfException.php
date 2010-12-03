<?php

namespace Respect\Validation\Exceptions;

class NoneOfException extends ValidationException
{
    const INVALID_NONEOF= 'Hexa_1';
    public static $defaultTemplates = array(
        self::INVALID_NONEOF => 'None of the %3$d must pass. %3$d passed',
    );

}