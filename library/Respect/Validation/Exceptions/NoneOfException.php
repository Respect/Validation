<?php

namespace Respect\Validation\Exceptions;

class NoneOfException extends ValidationException
{
    const INVALID_NONE= 'None_1';
    public static $defaultTemplates = array(
        self::INVALID_NONE => 'None of the %d rules must pass. %d of them passed.',
    );

}