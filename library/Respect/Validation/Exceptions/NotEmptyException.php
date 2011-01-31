<?php

namespace Respect\Validation\Exceptions;

class NotEmptyException extends ValidationException
{

    public static $defaultTemplates = array(
        'The provided value is empty',
    );

}