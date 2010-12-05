<?php

namespace Respect\Validation\Exceptions;

class BetweenException extends ValidationException
{
    const INVALID_BETWEEN= 'Between_1';
    public static $defaultTemplates = array(
        self::INVALID_BETWEEN => '"%s" is out of bounds',
    );

}