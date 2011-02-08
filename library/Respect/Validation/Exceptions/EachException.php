<?php

namespace Respect\Validation\Exceptions;

class EachException extends ValidationException
{

    public static $defaultTemplates = array(
       self::STANDARD =>  'Each item in %s must be valid',
    );

}