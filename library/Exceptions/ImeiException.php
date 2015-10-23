<?php

namespace Respect\Validation\Exceptions;

class ImeiException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{input}} must be a valid IMEI',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{input}} must not be a valid IMEI',
        ],
    ];
}
