<?php

namespace Respect\Validation\Exceptions;

class IntException extends ValidationException
{
    const INVALID_INT= 'Int_1';
    public static $defaultTemplates = array(
        self::INVALID_INT => '"%s" is not a valid integer number',
    );

}