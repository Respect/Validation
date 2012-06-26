<?php

namespace Respect\Validation\Exceptions;

class TodayException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be today',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be today',
        )
    );

}

