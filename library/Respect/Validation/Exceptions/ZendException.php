<?php

namespace Respect\Validation\Exceptions;

class ZendException extends ValidationException
{
    const INVALID_Zend= 'Zend_1';
    public static $defaultTemplates = array(
        self::INVALID_Zend => '%s',
    );
    
}