<?php

namespace Respect\Validation\Exceptions;

class KeyException extends AttributeException
{
    
    public static $defaultTemplates = array(
        self::NOT_PRESENT => '%1$s must be present',
        self::INVALID => 'Key %2$s must be valid on %1$s',
    );
}