<?php

namespace Respect\Validation\Exceptions;

class SfException extends ValidationException
{
    const INVALID_SF= 'Sf_1';
    public static $defaultTemplates = array(
        self::INVALID_SF => '%s',
    );

}