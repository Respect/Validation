<?php

namespace Respect\Validation\Exceptions;

class OneOfException extends ValidationException
{
    const INVALID_ONE_OF= 'OneOf_1';
    public static $defaultTemplates = array(
        self::INVALID_ONE_OF => 'None of the %d rules passed',
    );

}