<?php

namespace Respect\Validation\Exceptions;

class LuhnException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid Card Number',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid Card Number',
        ]
    ];
}
