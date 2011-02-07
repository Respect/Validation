<?php

namespace Respect\Validation\Exceptions;

class NotEmptyException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => 'The provided value is empty',
    );

}