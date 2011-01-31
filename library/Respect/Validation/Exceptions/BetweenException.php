<?php

namespace Respect\Validation\Exceptions;

class BetweenException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is out of bounds',
    );

}