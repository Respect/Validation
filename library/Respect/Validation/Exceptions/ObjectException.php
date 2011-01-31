<?php

namespace Respect\Validation\Exceptions;

class ObjectException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not an object',
    );

}