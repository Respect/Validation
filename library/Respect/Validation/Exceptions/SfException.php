<?php

namespace Respect\Validation\Exceptions;

class SfException extends ValidationException
{
    const INVALID_DF= 'DF_1';
    public static $defaultTemplates = array(
        self::INVALID_DF => '%s',
    );

}