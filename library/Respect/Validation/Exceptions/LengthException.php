<?php

namespace Respect\Validation\Exceptions;

class LengthException extends BetweenException
{

    public static $defaultTemplates = array(
        self::BOTH => '{{name}} must have a length between {{minValue}} and {{maxValue}}',
        self::LOWER => '{{name}} must have a length greater than {{minValue}}',
        self::GREATER => '{{name}} must have a length lower than {{maxValue}}',
    );

}
