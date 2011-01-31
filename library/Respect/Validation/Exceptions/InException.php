<?php

namespace Respect\Validation\Exceptions;

class InException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not in %s',
    );

}