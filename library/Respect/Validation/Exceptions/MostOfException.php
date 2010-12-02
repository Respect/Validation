<?php

namespace Respect\Validation\Exceptions;

class MostOfException extends ValidationException
{
    const INVALID_MOST= 'Most_1';
    public static $defaultTemplates = array(
        self::INVALID_MOST => '%d of the %d required rules did not passed',
    );

}