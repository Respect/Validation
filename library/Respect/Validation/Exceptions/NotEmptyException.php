<?php

namespace Respect\Validation\Exceptions;

class NotEmptyException extends ValidationException
{
    const INVALID_NOT_EMPTY= 'NotEmpty_1';
    public static $defaultTemplates = array(
        self::INVALID_NOT_EMPTY => 'The provided value is empty',
    );

}