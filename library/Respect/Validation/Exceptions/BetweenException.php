<?php

namespace Respect\Validation\Exceptions;

class BetweenException extends ValidationException
{
    const INVALID_LESS= 'Between_1';
    const INVALID_MORE= 'Between_2';
    const INVALID_BOUNDS= 'Between_3';
    public static $defaultTemplates = array(
        self::INVALID_LESS => '"%s" is less than "%s"',
        self::INVALID_MORE => '"%s" is more than "%s"',
        self::INVALID_BOUNDS => '"%s" is out of bounds',
    );

}