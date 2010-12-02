<?php

namespace Respect\Validation\Exceptions;

class AtLeastException extends ValidationException
{
    const INVALID_ATLEAST = 'AtLeast_1';
    public static $defaultTemplates = array(
        self::INVALID_ATLEAST => '%d of the %d mandatory rules are invalid',
    );

}