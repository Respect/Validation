<?php

namespace Respect\Validation\Exceptions;

class AllOfException extends ValidationException
{
    const INVALID_ALLOF= 'AllOf_1';
    public static $defaultTemplates = array(
        self::INVALID_ALLOF => '%d of the %d required rules did not passed',
    );

}